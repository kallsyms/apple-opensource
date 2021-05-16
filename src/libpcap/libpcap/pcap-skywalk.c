/* -*- Mode: c; tab-width: 8; indent-tabs-mode: 1; c-basic-offset: 8; -*- */
/*
 * Copyright (c) 2015 Apple Inc. All rights reserved.
 *
 * @APPLE_LICENSE_HEADER_START@
 *
 * This file contains Original Code and/or Modifications of Original Code
 * as defined in and that are subject to the Apple Public Source License
 * Version 2.0 (the 'License'). You may not use this file except in
 * compliance with the License. Please obtain a copy of the License at
 * http://www.opensource.apple.com/apsl/ and read it before using this
 * file.
 *
 * The Original Code and all software distributed under the License are
 * distributed on an 'AS IS' basis, WITHOUT WARRANTY OF ANY KIND, EITHER
 * EXPRESS OR IMPLIED, AND APPLE HEREBY DISCLAIMS ALL SUCH WARRANTIES,
 * INCLUDING WITHOUT LIMITATION, ANY WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE, QUIET ENJOYMENT OR NON-INFRINGEMENT.
 * Please see the License for the specific language governing rights and
 * limitations under the License.
 *
 * @APPLE_LICENSE_HEADER_END@
 */

#ifdef HAVE_CONFIG_H
#include "config.h"
#endif

#include <stdio.h>
#include <stdlib.h>
#include <errno.h>
#include <string.h>

#include <sys/types.h>
#include <sys/event.h>
#include <sys/time.h>

#include <uuid/uuid.h>

#include <skywalk/os_channel.h>

#include "pcap-int.h"

static int skywalk_debug = 0;

#define DPRINTF(fmt, ...) do {			\
	if (skywalk_debug) {			\
		printf("%s: ", __func__);	\
		printf(fmt, __VA_ARGS__);	\
	}					\
} while (0)

enum {
	CHAN_RX = 0,
	CHAN_TX = 1,

	CHAN_MAX
};

struct pcap_skywalk {
	int kfd;
	uuid_t uuid;
	nexus_port_t port;
	channel_t channel[CHAN_MAX];
	int chan_fd[CHAN_MAX];
	ring_id_t first_rx, last_rx;
	ring_id_t first_tx, last_tx;
	unsigned int npkts;
};

static int
skywalk_set_datalink(pcap_t *p, int dlt)
{

	DPRINTF("%p dlt %d\n", p, dlt);
	p->linktype = dlt;

	return 0;
}

static void
skywalk_dispatch_ring(struct pcap_skywalk *ps, const struct bpf_insn *pc,
    pcap_handler cb, unsigned char *user, channel_ring_t ring, int *cnt)
{
	struct pcap_pkthdr hdr;
	slot_prop_t prop;
	channel_slot_t slot;
	channel_slot_t last_slot = NULL;
	unsigned char *p;

	bzero(&hdr, sizeof(hdr));
	slot = os_channel_get_next_slot(ring, NULL, &prop);
	while (slot != NULL) {
		ps->npkts++;
		p = (unsigned char *)prop.sp_buf_ptr;
		hdr.caplen = hdr.len = prop.sp_len;
		gettimeofday(&hdr.ts, NULL);
		DPRINTF("pkt %p len %u\n", p, hdr.len);
		if (pc == NULL || bpf_filter(pc, p, hdr.len, hdr.caplen)) {
			cb(user, &hdr, p);
			if (*cnt > 0) {
				*cnt = *cnt - 1;
				if (*cnt == 0)
					break;
			}
		}
		last_slot = slot;
		slot = os_channel_get_next_slot(ring, slot, &prop);
	}
	if (last_slot != NULL) {
		os_channel_advance_slot(ring, last_slot);
	}
}

static int
skywalk_dispatch(pcap_t *p, int cnt, pcap_handler cb, unsigned char *user)
{
	const struct bpf_insn *pc;
	struct pcap_skywalk *ps;
	channel_ring_t ring;
	unsigned int avail, i;
	struct kevent kev[CHAN_MAX], evlist;
	int ev;
	unsigned int npkts;

	ps = p->priv;
	pc = p->fcode.bf_insns;
	npkts = ps->npkts;
	DPRINTF("%p priv %p\n", p, p->priv);
	bzero(kev, sizeof(kev));
	EV_SET(&kev[CHAN_RX], 0, EVFILT_READ, EV_ADD | EV_ENABLE, 0, 0, NULL);
	EV_SET(&kev[CHAN_TX], 0, EVFILT_READ, EV_ADD | EV_ENABLE, 0, 0, NULL);
	for (;;) {
		if (p->break_loop) {
			p->break_loop = 0;
			return PCAP_ERROR_BREAK;
		}
		/* XXX must be set every time. */
		kev[CHAN_RX].ident = ps->chan_fd[CHAN_RX];
		kev[CHAN_TX].ident = ps->chan_fd[CHAN_TX];
		ev = kevent(ps->kfd, kev, CHAN_MAX, &evlist, 1, NULL);
		DPRINTF("ev %d\n", ev);
		if (ev <= 0 && (errno != 0 && errno != EAGAIN)) {
			if (p->break_loop)
				return PCAP_ERROR_BREAK;
			else {
				snprintf(p->errbuf, PCAP_ERRBUF_SIZE,
				    "kevent: %s", pcap_strerror(errno));
				return PCAP_ERROR;
			}
		}
		for (i = ps->first_rx; i <= ps->last_rx; i++) {
			if (p->break_loop)
				break;
			ring = os_channel_rx_ring(ps->channel[CHAN_RX], i);
			avail = os_channel_available_slot_count(ring);
			DPRINTF("rx ring %p avail %u\n", ring, avail);
			if (avail == 0)
				continue;
			skywalk_dispatch_ring(ps, pc, cb, user, ring, &cnt);
		}
		for (i = ps->first_tx; i <= ps->last_tx; i++) {
			if (p->break_loop)
				break;
			ring = os_channel_rx_ring(ps->channel[CHAN_TX], i);
			avail = os_channel_available_slot_count(ring);
			DPRINTF("tx ring %p avail %u\n", ring, avail);
			if (avail == 0)
				continue;
			skywalk_dispatch_ring(ps, pc, cb, user, ring, &cnt);
		}
		if (cnt == 0)
			break;
	}

	return ((int)(ps->npkts - npkts)) > 0 ? 1 : 0;
}

static int
skywalk_inject(pcap_t *p, const void *buf, size_t size)
{
#pragma unused(buf, size)
	snprintf(p->errbuf, PCAP_ERRBUF_SIZE,
	    "packet injection is not supported in a monitoring channel");

	return PCAP_ERROR;
}

static int
skywalk_stats(pcap_t *p, struct pcap_stat *lps)
{
	struct pcap_skywalk *ps;

	ps = p->priv;
	lps->ps_drop = 0;
	lps->ps_ifdrop = 0;
	lps->ps_recv = ps->npkts;

	return 0;
}

static void
skywalk_close(pcap_t *p)
{
	int i;
	struct pcap_skywalk *ps;

	ps = p->priv;
	DPRINTF("%p priv %p\n", p, p->priv);
	for (i = 0; i < CHAN_MAX; i++) {
		os_channel_destroy(ps->channel[i]);
		ps->channel[i] = NULL;
	}
	if (p->dlt_list)
		free(p->dlt_list);
	if (p->selectable_fd_list)
		free(p->selectable_fd_list);
}

static int
skywalk_activate(pcap_t *p)
{
	struct pcap_skywalk *ps;
	channel_attr_t attr;

	DPRINTF("%p\n", p);
	ps = p->priv;
	if ((ps->kfd = kqueue()) < 0) {
		snprintf(p->errbuf, PCAP_ERRBUF_SIZE,
		    "unable to create a kqueue: %s",
		    pcap_strerror(errno));
		return (PCAP_ERROR);
	}
	attr = os_channel_attr_create();
	if (attr == NULL) {
		snprintf(p->errbuf, PCAP_ERRBUF_SIZE,
		    "unable to create an attribute: %s",
		    pcap_strerror(errno));
		return (PCAP_ERROR);
	}
	os_channel_attr_set(attr, CHANNEL_ATTR_MONITOR,
	    CHANNEL_MONITOR_COPY);
	ps->channel[CHAN_RX] = os_channel_create_extended(ps->uuid, ps->port,
	    CHANNEL_DIR_RX, CHANNEL_RING_ID_ANY, attr);
	if (ps->channel[CHAN_RX] == NULL) {
		snprintf(p->errbuf, PCAP_ERRBUF_SIZE,
		    "unable to create an RX channel: %s",
		    pcap_strerror(errno));
		os_channel_attr_destroy(attr);
		return (PCAP_ERROR);
	}
	ps->channel[CHAN_TX] = os_channel_create_extended(ps->uuid, ps->port,
	    CHANNEL_DIR_TX, CHANNEL_RING_ID_ANY, attr);
	if (ps->channel[CHAN_TX] == NULL) {
		snprintf(p->errbuf, PCAP_ERRBUF_SIZE,
		    "unable to create a TX channel: %s",
		    pcap_strerror(errno));
		os_channel_destroy(ps->channel[CHAN_RX]);
		ps->channel[CHAN_RX] = NULL;
		os_channel_attr_destroy(attr);
		return (PCAP_ERROR);
	}
	os_channel_attr_destroy(attr);
	ps->first_rx = os_channel_ring_id(ps->channel[CHAN_RX],
	    CHANNEL_FIRST_RX_RING);
	ps->last_rx = os_channel_ring_id(ps->channel[CHAN_RX],
	    CHANNEL_LAST_RX_RING);
	ps->first_tx = os_channel_ring_id(ps->channel[CHAN_TX],
	    CHANNEL_FIRST_TX_RING);
	ps->last_tx = os_channel_ring_id(ps->channel[CHAN_TX],
	    CHANNEL_LAST_TX_RING);
	DPRINTF("rx[%u,%u], tx[%u,%u]\n", ps->first_rx, ps->last_rx,
	    ps->first_tx, ps->last_tx);
	ps->chan_fd[CHAN_RX] = os_channel_get_fd(ps->channel[CHAN_RX]);
	ps->chan_fd[CHAN_TX] = os_channel_get_fd(ps->channel[CHAN_TX]);
	/*
	 * The link type defaults to Ethernet, but anything can be sent
	 * inside the channel.  Ideally, the channel would have some sort of
	 * property that would let us detect which type of packets are flowing
	 * through it.
	 */
	p->linktype = DLT_EN10MB;
	p->dlt_list = malloc(sizeof(u_int) * 5);
	if (p->dlt_list) {
		p->dlt_list[0] = DLT_EN10MB;
		p->dlt_list[1] = DLT_NULL;
		p->dlt_list[2] = DLT_RAW;
		p->dlt_list[3] = DLT_IPV4;
		p->dlt_list[4] = DLT_IPV6;
		p->dlt_count = 5;
	}
	p->set_datalink_op = skywalk_set_datalink;
	p->fd = -1;
	p->selectable_fd_list = malloc(sizeof(int) * 2);
	if (p->selectable_fd_list) {
		p->selectable_fd_list[0] =
		    os_channel_get_fd(ps->channel[CHAN_RX]);
		p->selectable_fd_list[1] =
		    os_channel_get_fd(ps->channel[CHAN_TX]);
		p->selectable_fd_count = 2;
	}
	p->read_op = skywalk_dispatch;
	p->inject_op = skywalk_inject;
	p->setfilter_op = install_bpf_program;
	p->setdirection_op = NULL;
	p->getnonblock_op = pcap_getnonblock_fd;
	p->setnonblock_op = pcap_setnonblock_fd;
	p->stats_op = skywalk_stats;
	p->cleanup_op = skywalk_close;

	return 0;
}

pcap_t *
skywalk_create(const char *device, char *ebuf, int *is_ours)
{
	pcap_t *p;
	char *s_port, *s_uuid, *s, *tofree;
	struct pcap_skywalk *ps;
	nexus_port_t port;
	uuid_t uuid;
	char *env;

	env = getenv("PCAP_SKYWALK_DEBUG");
	if (env)
		skywalk_debug = atoi(env);
	/* Accepts skywalk:UUID or skywalk:UUID:port. */
	*is_ours = strncmp(device, "skywalk:", 8) == 0;
	if (!*is_ours)
		return NULL;
	device += 8;
	port = 0;
	s = tofree = strdup(device);
	s_uuid = strsep(&s, ":");
	s_port = strsep(&s, ":");
	if (s_port && *s_port != '\0')
		port = (nexus_port_t)strtoul(s_port, NULL, 10);
	if (uuid_parse(s_uuid, uuid) != 0) {
		snprintf(ebuf, PCAP_ERRBUF_SIZE,
		    "invalid UUID: %s", s_uuid);
		free(tofree);
		return NULL;
	}
	p = pcap_create_common(ebuf, sizeof(struct pcap_skywalk));
	DPRINTF("%p, uuid %s, port %u\n", p, s_uuid, port);
	free(tofree);
	if (p == NULL)
		return NULL;
	p->activate_op = skywalk_activate;
	ps = p->priv;
	bzero(ps, sizeof(*ps));
	uuid_copy(ps->uuid, uuid);
	ps->port = port;

	return p;
}


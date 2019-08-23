/*
 * CDDL HEADER START
 *
 * The contents of this file are subject to the terms of the
 * Common Development and Distribution License (the "License").
 * You may not use this file except in compliance with the License.
 *
 * You can obtain a copy of the license at usr/src/OPENSOLARIS.LICENSE
 * or http://www.opensolaris.org/os/licensing.
 * See the License for the specific language governing permissions
 * and limitations under the License.
 *
 * When distributing Covered Code, include this CDDL HEADER in each
 * file and include the License file at usr/src/OPENSOLARIS.LICENSE.
 * If applicable, add the following below this CDDL HEADER, with the
 * fields enclosed by brackets "[]" replaced with your own identifying
 * information: Portions Copyright [yyyy] [name of copyright owner]
 *
 * CDDL HEADER END
 */

/*
 * ASSERTION:
 *	vm_kernel_addrperm() should handle as an error:
 *		- no arg
 *		- too many args
 *
 * SECTION: Actions and Subroutines/vm_kernel_addrperm()
 *
 */

#pragma D option quiet



BEGIN
{
	p = vm_kernel_addrperm();
	p = vm_kernel_addrperm((void*) 1, (void*) 2);

	exit(1);
}
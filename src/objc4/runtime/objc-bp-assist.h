/*
 * Copyright (c) 2020 Apple Inc.  All Rights Reserved.
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

#ifndef _OBJC_BP_ASSIST_H
#define _OBJC_BP_ASSIST_H

/// Code for setting up the H14 ObjC branch prediction control registers.
/// This gets its own header so that the objcBPAssist test can easily
/// validate the values it passes.

#include <mach/mach.h>
#include <objc/message.h>
#include <stdint.h>
#include <TargetConditionals.h>

#include "objc-config.h"

// We need this #define to see the SYS_* defines.
#define __APPLE_API_PRIVATE
#include <sys/syscall.h>

#ifndef ASSERT
#include <assert.h>
#define ASSERT assert
#endif

#if HAS_OBJC_BP_ASSIST
#define ARM64_REG_BP_OBJC_ADR_EL1_mask                 (0x00ffffffffffffffull)
#define ARM64_REG_BP_OBJC_ADR_EL1_shift                (0)

#define ARM64_REG_BP_OBJC_CTL_EL1_Mask_mask            (0x001ffffff8000000ull)
#define ARM64_REG_BP_OBJC_CTL_EL1_Mask_shift           (27)

#define ARM64_REG_BP_OBJC_CTL_EL1_AR_ClassPtr_mask     (0x00000000003e0000ull)
#define ARM64_REG_BP_OBJC_CTL_EL1_AR_ClassPtr_shift    (17)

#define ARM64_REG_BP_OBJC_CTL_EL1_AR_Selector_mask     (0x000000000001f000ull)
#define ARM64_REG_BP_OBJC_CTL_EL1_AR_Selector_shift    (12)

#define ARM64_REG_BP_OBJC_CTL_EL1_Br_Offset_mask       (0x000000000000007full)
#define ARM64_REG_BP_OBJC_CTL_EL1_Br_Offset_shift      (0)

static inline void configureObjCBPAssist(kern_return_t (*configureFunc)(uint64_t adr, uint64_t ctl)) {
    void *msgSend = (void *)&objc_msgSend;
#if __has_feature(ptrauth_calls)
    msgSend = ptrauth_strip(msgSend, ptrauth_key_asia);
#endif
    uint64_t msgSendAddr = (uint64_t)msgSend;

#if __has_feature(ptrauth_calls)
#   if ISA_SIGNING_AUTH_MODE == ISA_SIGNING_AUTH
    uint64_t indirectBranchOffset = 17 * 4;
#   else
    uint64_t indirectBranchOffset = 15 * 4;
#   endif
#elif __LP64__
    uint64_t indirectBranchOffset = 13 * 4;
#else
    uint64_t indirectBranchOffset = 21 * 4;
#endif

#if CONFIG_USE_PREOPT_CACHES
    // Preoptimized caches add two additional instructions before the branch.
    indirectBranchOffset += 2 * 4;
#endif

    // Compute the control register value. For more detail on what
    // the various pieces mean, see Apple ISA Extensions to ARMv8:
    // version H14, chapter 23, "Software assisted Branch Prediction:
    // objc_msgSend".
    uint64_t enable = 0x8000000000000000ULL;
    uint64_t mask = 0x0000000000000000ULL;
    uint64_t classPtrRegister = 16; // Class pointer is loaded into x16
    uint64_t selectorRegister = 1; // Selector is in x1.

    uint64_t controlRegisterValue = enable;
    controlRegisterValue |= mask;
    controlRegisterValue |= classPtrRegister << ARM64_REG_BP_OBJC_CTL_EL1_AR_ClassPtr_shift;
    controlRegisterValue |= selectorRegister << ARM64_REG_BP_OBJC_CTL_EL1_AR_Selector_shift;
    controlRegisterValue |= indirectBranchOffset << ARM64_REG_BP_OBJC_CTL_EL1_Br_Offset_shift;

    ASSERT((controlRegisterValue & ARM64_REG_BP_OBJC_CTL_EL1_Mask_mask) == mask);
    ASSERT((controlRegisterValue & ARM64_REG_BP_OBJC_CTL_EL1_AR_ClassPtr_mask) >> ARM64_REG_BP_OBJC_CTL_EL1_AR_ClassPtr_shift == classPtrRegister);
    ASSERT((controlRegisterValue & ARM64_REG_BP_OBJC_CTL_EL1_AR_Selector_mask) >> ARM64_REG_BP_OBJC_CTL_EL1_AR_Selector_shift == selectorRegister);
    ASSERT((controlRegisterValue & ARM64_REG_BP_OBJC_CTL_EL1_Br_Offset_mask) >> ARM64_REG_BP_OBJC_CTL_EL1_Br_Offset_shift == indirectBranchOffset);

    // Ignore the return value. It's expected to fail on hardware
    // that doesn't support this feature.
    configureFunc(msgSendAddr, controlRegisterValue);
}
#endif


#endif // _OBJC_BP_ASSIST_H

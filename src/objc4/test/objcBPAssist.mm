// TEST_CONFIG ARCH=arm64,arm64e,arm64_32

#include "../runtime/objc-config.h"
#include "../runtime/objc-bp-assist.h"
#include <objc/objc-gdb.h>
#include <test.h>

#if HAS_OBJC_BP_ASSIST
static kern_return_t Configure(uint64_t adr, uint64_t ctl) {
    void *msgSend = (void *)objc_msgSend;
#if __has_feature(ptrauth_calls)
    msgSend = ptrauth_strip((void *)objc_msgSend, ptrauth_key_asia);
#endif
    testassertequal(adr, (uint64_t)msgSend);

#if __has_feature(ptrauth_calls)
    uint32_t branchInstruction = 0xd71f0e2a; // brab x17, x10
#else
    uint32_t branchInstruction = 0xd61f0220; // br x17
#endif


    uint64_t offset = (ctl & ARM64_REG_BP_OBJC_CTL_EL1_Br_Offset_mask)
                      >> ARM64_REG_BP_OBJC_CTL_EL1_Br_Offset_shift;
    testprintf("offset=%llx\n", offset);
    uint32_t *branchInstructionPointer = (uint32_t *)(adr + offset);
    if (branchInstruction != *branchInstructionPointer) {
        for (uint8_t *i = (uint8_t *)adr; i <= (uint8_t *)branchInstructionPointer; i += sizeof(uint32_t)) {
            testprintf("INSTRUCTION %02x %02x %02x %02x\n", i[0], i[1], i[2], i[3]);
        }
    }
    testassertequal(branchInstruction, *branchInstructionPointer);

    uint64_t mask = (ctl & ARM64_REG_BP_OBJC_CTL_EL1_Mask_mask)
                    >> ARM64_REG_BP_OBJC_CTL_EL1_Mask_shift;
    // We don't currently set any mask.
    testassertequal(mask, 0);

    uint64_t classPtrRegister = (ctl & ARM64_REG_BP_OBJC_CTL_EL1_AR_ClassPtr_mask)
                                >> ARM64_REG_BP_OBJC_CTL_EL1_AR_ClassPtr_shift;
    testassertequal(classPtrRegister, 16); // Class pointer is in x16.

    uint64_t selRegister = (ctl & ARM64_REG_BP_OBJC_CTL_EL1_AR_Selector_mask)
                           >> ARM64_REG_BP_OBJC_CTL_EL1_AR_Selector_shift;
    testassertequal(selRegister, 1); // Selector is in x1.

    return KERN_SUCCESS;
}

int main() {
    // Don't run this as an ARM64 test on ARM64e, we'll get the offsets and
    // instructions all wrong.
    int arm64TestWithARM64eObjC = objc_debug_isa_magic_value == 1 && !__has_feature(ptrauth_calls);
    if (!arm64TestWithARM64eObjC)
        configureObjCBPAssist(Configure);
    succeed(__FILE__);
}
#else
int main() {
    succeed(__FILE__);
}
#endif

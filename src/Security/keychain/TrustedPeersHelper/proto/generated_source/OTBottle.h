// This file was automatically generated by protocompiler
// DO NOT EDIT!
// Compiled from OTBottle.proto

#import <Foundation/Foundation.h>
#import <ProtocolBuffer/PBCodable.h>

@class OTAuthenticatedCiphertext;

#ifdef __cplusplus
#define OTBOTTLE_FUNCTION extern "C" __attribute__((visibility("hidden")))
#else
#define OTBOTTLE_FUNCTION extern __attribute__((visibility("hidden")))
#endif

__attribute__((visibility("hidden")))
@interface OTBottle : PBCodable <NSCopying>
{
    NSString *_bottleID;
    OTAuthenticatedCiphertext *_contents;
    NSData *_escrowedEncryptionSPKI;
    NSData *_escrowedSigningSPKI;
    NSData *_peerEncryptionSPKI;
    NSString *_peerID;
    NSData *_peerSigningSPKI;
    NSData *_reserved3;
    NSData *_reserved4;
    NSData *_reserved5;
    NSData *_reserved6;
    NSData *_reserved7;
}


@property (nonatomic, readonly) BOOL hasPeerID;
@property (nonatomic, retain) NSString *peerID;

@property (nonatomic, readonly) BOOL hasBottleID;
@property (nonatomic, retain) NSString *bottleID;

@property (nonatomic, readonly) BOOL hasReserved3;
/**
 * Tags 3, 4, 5 and 6 were briefly used during development for the raw public key data, with nothing to specify the key type.
 * They are replaced with the following, encoded as SubjectPublicKeyInfo:
 */
@property (nonatomic, retain) NSData *reserved3;

@property (nonatomic, readonly) BOOL hasReserved4;
@property (nonatomic, retain) NSData *reserved4;

@property (nonatomic, readonly) BOOL hasReserved5;
@property (nonatomic, retain) NSData *reserved5;

@property (nonatomic, readonly) BOOL hasReserved6;
@property (nonatomic, retain) NSData *reserved6;

@property (nonatomic, readonly) BOOL hasEscrowedSigningSPKI;
/** as SubjectPublicKeyInfo (SPKI): */
@property (nonatomic, retain) NSData *escrowedSigningSPKI;

@property (nonatomic, readonly) BOOL hasEscrowedEncryptionSPKI;
@property (nonatomic, retain) NSData *escrowedEncryptionSPKI;

@property (nonatomic, readonly) BOOL hasPeerSigningSPKI;
@property (nonatomic, retain) NSData *peerSigningSPKI;

@property (nonatomic, readonly) BOOL hasPeerEncryptionSPKI;
@property (nonatomic, retain) NSData *peerEncryptionSPKI;

@property (nonatomic, readonly) BOOL hasReserved7;
/** Tag 7 was briefly used during development for contents encoded with NSKeyedArchiver. */
@property (nonatomic, retain) NSData *reserved7;

@property (nonatomic, readonly) BOOL hasContents;
@property (nonatomic, retain) OTAuthenticatedCiphertext *contents;

// Performs a shallow copy into other
- (void)copyTo:(OTBottle *)other;

// Performs a deep merge from other into self
// If set in other, singular values in self are replaced in self
// Singular composite values are recursively merged
// Repeated values from other are appended to repeated values in self
- (void)mergeFrom:(OTBottle *)other;

OTBOTTLE_FUNCTION BOOL OTBottleReadFrom(__unsafe_unretained OTBottle *self, __unsafe_unretained PBDataReader *reader);

@end

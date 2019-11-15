<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Credentials;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class CredentialsNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CredentialsNormalizer implements NormalizerInterface
{
    /**
     * @inheritDoc
     *
     * @param Credentials $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            "payerId"           => $object->getPayerId(),
            "payerAddressId"    => $object->getPayerAddressId(),
            "senderId"          => $object->getSenderId(),
            "senderAddressId"   => $object->getSenderAddressId(),
            "departureUnitId"   => $object->getDepartureUnitId(),
            "senderZipCode"     => $object->getSenderZipCode(),
            "senderCountryCode" => $object->getSenderCountryCode(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Credentials
            && in_array($format, ['json', null], true);
    }
}

<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\CancelPickupOrderRequest;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class CancelPickupOrderRequestNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CancelPickupOrderRequestNormalizer implements NormalizerInterface
{
    /**
     * @inheritDoc
     *
     * @param CancelPickupOrderRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            "callId" => $object->getCallId(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof CancelPickupOrderRequest
            && in_array($format, ['json', null], true);
    }
}

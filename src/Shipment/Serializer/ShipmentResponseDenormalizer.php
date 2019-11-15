<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Response\ShipmentResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class ShipmentResponseDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentResponseDenormalizer implements DenormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        // Documentation says that 'tempShpId' key should be in response,
        // but the example response is just an array of int...
        if (isset($data['tempShpId'])) {
            $data = $data['tempShpId'];
        }

        return new ShipmentResponse($data);
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === ShipmentResponse::class
            && in_array($format, ['json', null], true);
    }
}

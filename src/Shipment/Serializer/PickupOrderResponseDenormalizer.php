<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Response\PickupOrderResponse;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class PickupOrderResponseDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class PickupOrderResponseDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $keys = ['callId', 'responseMessage', 'coreInfoMessage'];

        if (0 < count($missing = array_diff($keys, array_keys($data)))) {
            throw new UnexpectedValueException(sprintf("Keys %s are missing.", implode(', ', $missing)));
        }

        return new PickupOrderResponse(
            (int)$data['callId'],
            $data['responseMessage'] ? (string) $data['responseMessage'] : null,
            $data['coreInfoMessage'] ? (int) $data['coreInfoMessage'] : null
        );
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === PickupOrderResponse::class
            && in_array($format, ['json', null], true);
    }
}

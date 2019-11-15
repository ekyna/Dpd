<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Response\CancelCollectionResponse;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class CancelCollectionResponseDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CancelCollectionResponseDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        if (1 === count($data)) {
            $data = reset($data);
        }

        $keys = ['reqStatus', 'transferStatus'];

        if (0 < count($missing = array_diff($keys, array_keys($data)))) {
            throw new UnexpectedValueException(sprintf("Keys %s are missing.", implode(', ', $missing)));
        }

        return new CancelCollectionResponse(
            (string)$data['reqStatus'],
            $data['transferStatus'] ? (string)$data['transferStatus'] : null
        );
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === CancelCollectionResponse::class
            && in_array($format, ['json', null], true);
    }
}

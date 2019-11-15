<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Shipment;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class ShipmentDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentDenormalizer implements DenormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $keys = ['parcels', 'shpId', 'returnShpId', 'manifestId', 'masterParcelId', 'returnParcels'];

        if (0 < count($missing = array_diff($keys, array_keys($data)))) {
            throw new UnexpectedValueException(sprintf("Keys %s are missing.", implode(', ', $missing)));
        }

        return new Shipment(
            $data['parcels'],
            $data['shpId'],
            $data['returnShpId'],
            $data['manifestId'],
            $data['masterParcelId'],
            $data['returnParcels']
        );
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === Shipment::class
            && in_array($format, ['json', null], true);
    }
}

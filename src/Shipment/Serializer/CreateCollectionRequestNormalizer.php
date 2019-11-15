<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\AddressTypes;
use Ekyna\Component\Dpd\Shipment\Request\CreateCollectionRequest;

/**
 * Class CreateCollectionRequestNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreateCollectionRequestNormalizer extends AbstractNormalizer
{
    /**
     * @inheritDoc
     *
     * @param CreateCollectionRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return array_replace(
            [
                "reqChannel"        => $object->getReqChannel(),
                "custref"           => $object->getCustref(),
                "weight"            => $object->getWeight(),
                "parcelCount"       => $object->getParcelCount(),
                "desiredPickupDate" => $object->getDesiredPickupDate()->format('Ymd'),
            ],
            $this->normalizeAddress($object->getPickupAddress(), AddressTypes::PICKUP, $format, $context),
            $this->normalizeAddress($object->getDeliveryAddress(), AddressTypes::DELIVERY, $format, $context)
        );
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof CreateCollectionRequest
            && in_array($format, ['json', null], true);
    }
}

<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\CreatePickupOrderRequest;

/**
 * Class CreatePickupOrderRequestNormalizer
 * @package Ekyna\Component\Dpd\Shipment\Serializer
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreatePickupOrderRequestNormalizer extends AbstractNormalizer
{
    /**
     * @inheritDoc
     *
     * @param CreatePickupOrderRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = $this->normalizer->normalize($object->getCredentials(), $format, $context);
        unset($data['departureUnitId']);

        $data = array_replace($data, [
            "reqChannel"         => $object->getReqChannel(),
            "callType"           => $object->getCallType(),
            "contactPerson"      => $object->getContactPerson(),
            "desiredPickUpDate"  => $object->getFromDate()->format('Ymd'),
            "desiredPickUpTime1" => $object->getFromDate()->format('His'),
            "desiredPickUpTime2" => $object->getToDate()->format('His'),
        ]);

        return $data;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof CreatePickupOrderRequest
            && in_array($format, ['json', null], true);
    }
}

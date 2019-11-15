<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\AddressTypes;
use Ekyna\Component\Dpd\Shipment\Model\Products;
use Ekyna\Component\Dpd\Shipment\Request\ShipmentRequest;

/**
 * Class ShipmentRequestNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentRequestNormalizer extends AbstractNormalizer
{
    /**
     * @inheritDoc
     *
     * @param ShipmentRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = array_replace(
            [
                "shipmentDate"      => $object->getShipmentDate()->format('Ymd'),
                "replaceSender"     => $object->isReplaceSender(),
                "parcelShopId"      => $object->getParcelShopId(),
                "returnType"        => $object->getReturnType(),
                "sameReturnAddress" => $object->isSameReturnAddress(),
                "mps"               => $object->isMps(),
                "parcels"           => $this->normalizer->normalize($object->getParcels(), $format, $context),
                "products"          => [
                    "productId" => Products::getCode($object->getProduct()),
                ],
            ],
            $this->normalizer->normalize($object->getCredentials(), $format, $context),
            $this->normalizeAddress($object->getReceiver(), AddressTypes::RECEIVER, $format, $context)
        );

        if ($address = $object->getReplaceSenderAddress()) {
            $data["replaceSenderAddress"] = $this->normalizeAddress($address, AddressTypes::SENDER, $format, $context);
        }

        if ($address = $object->getReturnAddress()) {
            $data["returnAddress"] = $this->normalizeAddress($address, AddressTypes::RETURN, $format, $context);
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof ShipmentRequest
            && in_array($format, ['json', null], true);
    }
}

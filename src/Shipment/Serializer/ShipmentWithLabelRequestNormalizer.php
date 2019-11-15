<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\ShipmentRequest;
use Ekyna\Component\Dpd\Shipment\Request\ShipmentWithLabelRequest;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

/**
 * Class ShipmentWithLabelRequestNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentWithLabelRequestNormalizer extends ShipmentRequestNormalizer
{
    use NormalizerAwareTrait;

    /**
     * @inheritDoc
     *
     * @param ShipmentRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = parent::normalize($object, $format, $context);

        if ($manifest = $object->getManifest()) {
            $data["manifest"] = $this->normalizer->normalize($manifest, $format, $context);
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof ShipmentWithLabelRequest
            && in_array($format, ['json', null], true);
    }
}

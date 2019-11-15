<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\ReprintLabelRequest;

/**
 * Class ReprintLabelRequestNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ReprintLabelRequestNormalizer extends ManifestNormalizer
{
    /**
     * @inheritDoc
     *
     * @param ReprintLabelRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = parent::normalize($object, $format, $context);

        $data = array_replace($data, [
            "labelStartPosition" => $object->getLabelStartPosition(),
            "parcelNumber"       => $object->getParcelNumber(),
        ]);

        return $data;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof ReprintLabelRequest
            && in_array($format, ['json', null], true);
    }
}

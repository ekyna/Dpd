<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\GetLabelRequest;

/**
 * Class GetLabelRequestNormalizer
 * @package Ekyna\Component\Dpd\Shipment\Serializer
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetLabelRequestNormalizer extends ManifestNormalizer
{
    /**
     * @inheritDoc
     *
     * @param GetLabelRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $data = parent::normalize($object, $format, $context);

        $data = array_replace($data, [
            "labelStartPosition" => $object->getLabelStartPosition(),
            "shpIdList"          => $object->getShpIdList(),
        ]);

        return $data;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof GetLabelRequest
            && in_array($format, ['json', null], true);
    }
}

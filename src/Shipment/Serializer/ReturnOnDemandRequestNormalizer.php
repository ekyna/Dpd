<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\ReturnOnDemandRequest;

/**
 * Class ReturnOnDemandRequestNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ReturnOnDemandRequestNormalizer extends ManifestNormalizer
{
    /**
     * @inheritDoc
     *
     * @param ReturnOnDemandRequest $object
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
        return $data instanceof ReturnOnDemandRequest
            && in_array($format, ['json', null], true);
    }
}

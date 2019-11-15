<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Manifest;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class ManifestNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ManifestNormalizer implements NormalizerInterface
{
    /**
     * @inheritDoc
     *
     * @param Manifest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            "labelFormat"        => $object->getLabelFormat(),
            "referenceAsBarcode" => $object->isReferenceAsBarcode(),
            "language"           => $object->getLanguage(),
            "fileType"           => $object->getFileType(),
            "dpi"                => $object->getDpi(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Manifest
            && in_array($format, ['json', null], true);
    }
}

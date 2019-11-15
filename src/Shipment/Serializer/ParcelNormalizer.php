<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Parcel;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class ParcelNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ParcelNormalizer implements NormalizerInterface
{
    /**
     * @inheritDoc
     *
     * @param Parcel $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            "cref1"      => $object->getCref1(),
            "cref2"      => $object->getCref2(),
            "cref3"      => $object->getCref3(),
            "cref4"      => $object->getCref4(),
            "hinsAmount" => round($object->getHinsAmount(), 2),
            "weight"     => round($object->getWeight(), 3),
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Parcel
            && in_array($format, ['json', null], true);
    }
}

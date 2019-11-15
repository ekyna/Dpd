<?php

namespace Ekyna\Component\Dpd\Relay\Serializer;

use Ekyna\Component\Dpd\Relay\Request\DetailRequest;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class DetailRequestNormalizer
 * @package Ekyna\Component\Dpd\Relay\Serializer
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class DetailRequestNormalizer implements NormalizerInterface
{
    /**
     * @inheritDoc
     *
     * @param DetailRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'pudo_id' => $object->getId(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof DetailRequest
            && in_array($format, ['json', null], true);
    }
}

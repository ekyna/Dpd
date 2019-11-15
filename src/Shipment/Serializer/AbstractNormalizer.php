<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Address;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class AbstractNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractNormalizer implements NormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * Normalizes the given address.
     *
     * @param Address $address
     * @param string  $type
     * @param string  $format
     * @param array $context
     *
     * @return array
     */
    protected function normalizeAddress(Address $address, string $type, string $format, array $context = []): array
    {
        return $this->normalizer->normalize($address, $format, array_replace($context, ['type' => $type]));
    }
}

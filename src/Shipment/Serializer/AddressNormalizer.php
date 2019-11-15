<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Address;
use Ekyna\Component\Dpd\Shipment\Model\AddressTypes;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class AddressNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class AddressNormalizer implements NormalizerInterface
{
    /**
     * @inheritDoc
     *
     * @param Address $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        $type = $context['type'] ?? AddressTypes::RECEIVER;

        $mapping = AddressTypes::getMapping($type);

        $accessor = PropertyAccess::createPropertyAccessor();

        $data = [];

        foreach ($mapping as $name => $config) {
            $value = $accessor->getValue($object, $name);

            if (isset($data[$config[0]])) {
                if (empty($data[$config[0]])) {
                    $data[$config[0]] = $value;
                } else {
                    $data[$config[0]] = trim($data[$config[0]] . ' ' . $value);
                }
            } else {
                $data[$config[0]] = $value;
            }
        }

        return $data;
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Address
            && in_array($format, ['json', null], true);
    }
}

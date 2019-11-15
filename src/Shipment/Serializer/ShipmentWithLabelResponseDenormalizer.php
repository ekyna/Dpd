<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Label;
use Ekyna\Component\Dpd\Shipment\Model\Shipment;
use Ekyna\Component\Dpd\Shipment\Response\ShipmentWithLabelResponse;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class ShipmentWithLabelResponseDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentWithLabelResponseDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $keys = ['shipments', 'label'];

        if (0 < count($missing = array_diff($keys, array_keys($data)))) {
            throw new UnexpectedValueException(sprintf("Keys %s are missing.", implode(', ', $missing)));
        }

        /** @var Label $label */
        $label = $this->denormalizer->denormalize($data['label'], Label::class, $format, $context);

        $shipments = [];
        foreach ($data['shipments'] as $datum) {
            $shipments[] = $this->denormalizer->denormalize($datum, Shipment::class, $format, $context);
        }

        return new ShipmentWithLabelResponse(
            $shipments,
            $label
        );
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === ShipmentWithLabelResponse::class
            && in_array($format, ['json', null], true);
    }
}

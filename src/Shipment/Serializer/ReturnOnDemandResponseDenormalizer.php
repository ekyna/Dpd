<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Label;
use Ekyna\Component\Dpd\Shipment\Response\ReturnOnDemandResponse;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class ReturnOnDemandResponseDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ReturnOnDemandResponseDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $keys = ['shpId', 'manifestId', 'parcels', 'label'];

        if (0 < count($missing = array_diff($keys, array_keys($data)))) {
            throw new UnexpectedValueException(sprintf("Keys %s are missing.", implode(', ', $missing)));
        }

        /** @var Label $label */
        $label = $this->denormalizer->denormalize($data['label'], Label::class, $format, $context);

        return new ReturnOnDemandResponse(
            $data['parcels'],
            $label,
            $data['shpId'],
            $data['manifestId']
        );
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === ReturnOnDemandResponse::class
            && in_array($format, ['json', null], true);
    }
}

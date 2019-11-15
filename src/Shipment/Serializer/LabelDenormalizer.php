<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Label;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class LabelDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class LabelDenormalizer implements DenormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $keys = ['fileName', 'fileContent', 'fileType'];
        if (0 < count($missing = array_diff($keys, array_keys($data)))) {
            throw new UnexpectedValueException(sprintf("Keys %s are missing.", implode(', ', $missing)));
        }

        return new $type($data['fileName'], base64_decode($data['fileContent']), $data['fileType']);
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === Label::class
            && in_array($format, ['json', null], true);
    }
}

<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\CancelCollectionRequest;

/**
 * Class CancelCollectionRequestNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CancelCollectionRequestNormalizer extends AbstractNormalizer
{
    /**
     * @inheritDoc
     *
     * @param CancelCollectionRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            "callId"       => $object->getCallId(),
            "parcelNumber" => $object->getParcelNumber(),
        ];
    }

    /**
     * @inheritDoc
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof CancelCollectionRequest
            && in_array($format, ['json', null], true);
    }
}

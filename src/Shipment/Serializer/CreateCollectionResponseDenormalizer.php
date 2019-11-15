<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Exception\RuntimeException;
use Ekyna\Component\Dpd\Shipment\Response\CreateCollectionResponse;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class CreateCollectionResponseDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreateCollectionResponseDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        if (1 === count($data)) {
            $data = reset($data);
        }

        $keys = [
            'coreInfoMessageId',
            'colReqId',
            'callId',
            'ordernr',
            'oid',
            'timeCreate',
            'dateCreate',
            'userCreate',
            'odepot',
            'rdepot',
            'cdepot',
            'parcelNo',
            'masterCallId',
        ];

        if (0 < count($missing = array_diff($keys, array_keys($data)))) {
            throw new UnexpectedValueException(sprintf("Keys %s are missing.", implode(', ', $missing)));
        }

        if (!$date = date_create_from_format('YmdHis', $data['dateCreate'] . $data['timeCreate'])) {
            throw new RuntimeException("Failed to parse creation date.");
        }

        return new CreateCollectionResponse(
            (int)$data['coreInfoMessageId'],
            (int)$data['colReqId'],
            (int)$data['callId'],
            (int)$data['ordernr'],
            (string)$data['oid'],
            $date,
            (string)$data['userCreate'],
            (string)$data['odepot'],
            (string)$data['rdepot'],
            (string)$data['cdepot'],
            (string)$data['parcelNo'],
            $data['masterCallId'] ? (int)$data['masterCallId'] : null
        );
    }

    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === CreateCollectionResponse::class
            && in_array($format, ['json', null], true);
    }
}

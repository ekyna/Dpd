<?php

namespace Ekyna\Component\Dpd\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Response\ReprintLabelResponse;

/**
 * Class ReprintLabelResponseDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ReprintLabelResponseDenormalizer extends LabelDenormalizer
{
    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === ReprintLabelResponse::class
            && in_array($format, ['json', null], true);
    }
}

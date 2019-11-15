<?php

namespace Ekyna\Component\Dpd\Relay\Serializer;

use Ekyna\Component\Dpd\Relay\Request\ListRequest;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Class ListRequestNormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ListRequestNormalizer implements NormalizerInterface
{
    /**
     * @inheritDoc
     *
     * @param ListRequest $object
     */
    public function normalize($object, $format = null, array $context = [])
    {
        return [
            'address'             => $object->getAddress(),
            'zipCode'             => $object->getZipCode(),
            'city'                => $object->getCity(),
            'requestID'           => $object->getRequestId(),
            'date_from'           => $object->getDate()->format('d/m/Y'),
            'countrycode'         => $object->getCountryCode() ?? 'fr',
            'max_pudo_number'     => (string) ($object->getMaxNumber() ?? ''),
            'max_distance_search' => (string) ($object->getMaxDistance() ?? ''),
            'weight'              => (string) ($object->getWeight() ?? ''),
            'category'            => $object->getCategory() ?? '',
            'holiday_tolerant'    => $object->isHoliday() ?? '',
        ];
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof ListRequest
            && in_array($format, ['json', null], true);
    }
}

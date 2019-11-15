<?php

namespace Ekyna\Component\Dpd\Relay\Serializer;

use Ekyna\Component\Dpd\Relay\Model\Item;
use Ekyna\Component\Dpd\Relay\Response\ListResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class ListResponseDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ListResponseDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $response = new ListResponse((int)$data['@quality'], (string)$data['REQUEST_ID']);

        if (!(isset($data['PUDO_ITEMS']) && is_array($data['PUDO_ITEMS']))) {
            return $response;
        }

        $data = $data['PUDO_ITEMS'];
        if (!(isset($data['PUDO_ITEM']) && is_array($data['PUDO_ITEM']))) {
            return $response;
        }

        $data = $data['PUDO_ITEM'];

        if (empty($data)) {
            return $response;
        }

        if (!is_int(current(array_keys($data)))) {
            /** @noinspection PhpParamsInspection */
            $response->addItem($this->denormalizer->denormalize($data, Item::class, $format, $context));

            return $response;
        }

        foreach ($data as $datum) {
            /** @noinspection PhpParamsInspection */
            $response->addItem($this->denormalizer->denormalize($datum, Item::class, $format, $context));
        }

        return $response;
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === ListResponse::class
            && in_array($format, ['xml', null], true);
    }
}

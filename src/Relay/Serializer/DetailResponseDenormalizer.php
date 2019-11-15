<?php

namespace Ekyna\Component\Dpd\Relay\Serializer;

use Ekyna\Component\Dpd\Relay\Model\Item;
use Ekyna\Component\Dpd\Relay\Response\DetailResponse;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class DetailResponseDenormalizer
 * @package Ekyna\Component\Dpd\Relay\Serializer
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class DetailResponseDenormalizer implements DenormalizerInterface, DenormalizerAwareInterface
{
    use DenormalizerAwareTrait;

    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $response = new DetailResponse();

        if (!isset($data['PUDO_ITEMS'])) {
            return $response;
        }

        $data = $data['PUDO_ITEMS'];

        if (!isset($data['PUDO_ITEM'])) {
            return $response;
        }

        /** @noinspection PhpParamsInspection */
        $response->setItem($this->denormalizer->denormalize($data['PUDO_ITEM'], Item::class, $format, $context));

        return $response;
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === DetailResponse::class
            && in_array($format, ['xml', null], true);
    }
}

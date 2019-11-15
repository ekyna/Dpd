<?php

namespace Ekyna\Component\Dpd\Relay\Serializer;

use Ekyna\Component\Dpd\Relay\Model\Holiday;
use Ekyna\Component\Dpd\Relay\Model\Item;
use Ekyna\Component\Dpd\Relay\Model\OpeningHour;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

/**
 * Class ItemDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ItemDenormalizer implements DenormalizerInterface
{
    /**
     * @inheritDoc
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        $item = new Item(
            $data['PUDO_ID'],
            (int)($data['DISTANCE'] ?? 0),
            $data['NAME'],
            $data['ADDRESS1'],
            $data['ADDRESS2'],
            $data['ADDRESS3'],
            $data['LOCAL_HINT'] ?? $data['LOCATION_HINT'] ?? '',
            $data['ZIPCODE'],
            $data['CITY'],
            (float)str_replace(',', '.', $data['LONGITUDE']),
            (float)str_replace(',', '.', $data['LATITUDE']),
            $data['MAP_URL'] ?? '',
            $data['AVAILABLE'] ?? ''
        );

        $this->createOpeningHours($item, $data);
        $this->createHolidayItems($item, $data);

        return $item;
    }

    /**
     * Creates opening hours.
     *
     * @param Item  $item
     * @param array $data
     */
    private function createOpeningHours(Item $item, array $data): void
    {
        if (!(isset($data['OPENING_HOURS_ITEMS']) && is_array($data['OPENING_HOURS_ITEMS']))) {
            return;
        }

        $data = $data['OPENING_HOURS_ITEMS'];
        if (!(isset($data['OPENING_HOURS_ITEM']) && is_array($data['OPENING_HOURS_ITEM']))) {
            return;
        }

        foreach ($data['OPENING_HOURS_ITEM'] as $datum) {
            $item->addOpeningHour(new OpeningHour(
                (int)$datum['DAY_ID'],
                $datum['START_TM'],
                $datum['END_TM']
            ));
        }
    }

    /**
     * Creates holiday items.
     *
     * @param Item  $item
     * @param array $data
     */
    private function createHolidayItems(Item $item, array $data): void
    {
        if (!(isset($data['HOLIDAY_ITEMS']) && is_array($data['HOLIDAY_ITEMS']))) {
            return;
        }

        $data = $data['HOLIDAY_ITEMS'];
        if (!(isset($data['HOLIDAY_ITEM']) && is_array($data['HOLIDAY_ITEM']))) {
            return;
        }

        foreach ($data['HOLIDAY_ITEMS']['HOLIDAY_ITEM'] as $h) {
            $item->addHoliday(new Holiday(
                $h['START_DTM'],
                $h['END_DTM']
            ));
        }
    }

    /**
     * @inheritDoc
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return !empty($data) && is_array($data)
            && $type === Item::class
            && in_array($format, ['xml', null], true);
    }
}

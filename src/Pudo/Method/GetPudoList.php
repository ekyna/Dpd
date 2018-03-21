<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Pudo\Method;

use Ekyna\Component\Dpd\Pudo\Model\Holiday;
use Ekyna\Component\Dpd\Pudo\Model\Item;
use Ekyna\Component\Dpd\Pudo\Model\OpeningHour;
use Ekyna\Component\Dpd\Pudo\Request\GetPudoListRequest;
use Ekyna\Component\Dpd\Pudo\Response\GetPudoListResponse;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class GetPudoDetails
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetPudoList extends AbstractMethod
{
    protected function getMethodName(): string
    {
        return 'GetPudoList';
    }

    protected function getRequestClass(): string
    {
        return GetPudoListRequest::class;
    }

    protected function parseResponse(string $xml): ResponseInterface
    {
        $root = new \SimpleXMLElement($xml);

        $response = new GetPudoListResponse((int)$root['quality'], (string)$root->REQUEST_ID);

        foreach ($root->PUDO_ITEMS->PUDO_ITEM as $i) {
            $item = new Item(
                (string)$i->PUDO_ID,
                (int)$i->DISTANCE,
                (string)$i->NAME,
                (string)$i->ADDRESS1,
                (string)$i->ADDRESS2,
                (string)$i->ADDRESS3,
                (string)$i->LOCAL_HINT,
                (string)$i->ZIPCODE,
                (string)$i->CITY,
                (float)str_replace(',', '.', $i->LONGITUDE),
                (float)str_replace(',', '.', $i->LATITUDE),
                (string)$i->MAP_URL,
                (string)$i->AVAILABLE
            );

            if ($i->OPENING_HOURS_ITEMS) {
                foreach ($i->OPENING_HOURS_ITEMS->OPENING_HOURS_ITEM as $o) {
                    $openingHour = new OpeningHour(
                        (int)$o->DAY_ID,
                        (string)$o->START_TM,
                        (string)$o->END_TM
                    );

                    $item->addOpeningHour($openingHour);
                }
            }

            if ($i->HOLIDAY_ITEMS) {
                foreach ($i->HOLIDAY_ITEMS->HOLIDAY_ITEM as $h) {
                    $holiday = new Holiday(
                        (string)$h->START_DTM,
                        (string)$h->END_DTM
                    );

                    $item->addHoliday($holiday);
                }
            }

            $response->addItem($item);
        }

        return $response;
    }
}

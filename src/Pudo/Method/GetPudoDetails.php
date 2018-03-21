<?php

namespace Ekyna\Component\Dpd\Pudo\Method;

use Ekyna\Component\Dpd\Pudo\Model\Holiday;
use Ekyna\Component\Dpd\Pudo\Model\Item;
use Ekyna\Component\Dpd\Pudo\Model\OpeningHour;
use Ekyna\Component\Dpd\Pudo\Request\GetPudoDetailsRequest;
use Ekyna\Component\Dpd\Pudo\Response\GetPudoDetailsResponse;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class GetPudoDetails
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetPudoDetails extends AbstractMethod
{
    protected function getMethodName(): string
    {
        return 'GetPudoDetails';
    }

    protected function getRequestClass(): string
    {
        return GetPudoDetailsRequest::class;
    }

    protected function parseResponse(string $xml): ResponseInterface
    {
        //echo $xml; exit();

        $root = new \SimpleXMLElement($xml);

        $i = $root->PUDO_ITEMS->PUDO_ITEM;

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

        return new GetPudoDetailsResponse($item);
    }
}

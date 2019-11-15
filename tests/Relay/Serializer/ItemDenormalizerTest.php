<?php

namespace Ekyna\Component\Dpd\Test\Relay\Serializer;

use Ekyna\Component\Dpd\Relay\Model\Item;
use Ekyna\Component\Dpd\Relay\Model\OpeningHour;
use Ekyna\Component\Dpd\Relay\Response\ListResponse;
use Ekyna\Component\Dpd\Relay\Serializer\ItemDenormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class ItemResponseDenormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ItemResponseDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $input = [
            '@active'             => 'true',
            'PUDO_ID'             => 'P55232',
            'DISTANCE'            => '3529',
            'NAME'                => 'CARREFOUR MARKET',
            'ADDRESS1'            => 'RUE DE LA CROIX AUX POTIERS',
            'ADDRESS2'            => '',
            'ADDRESS3'            => '',
            'LOCAL_HINT'          => '',
            'ZIPCODE'             => '35131',
            'CITY'                => 'CHARTRES DE BRETAGNE',
            'LONGITUDE'           => '-1,7122',
            'LATITUDE'            => '48,046550',
            'MAP_URL'             => '',
            'AVAILABLE'           => 'full',
            'OPENING_HOURS_ITEMS' => [
                'OPENING_HOURS_ITEM' => [
                    [
                        'DAY_ID'   => '1',
                        'START_TM' => '08:30',
                        'END_TM'   => '12:00',
                    ],
                    [
                        'DAY_ID'   => '1',
                        'START_TM' => '12:00',
                        'END_TM'   => '20:00',
                    ],
                ],
            ],
            'HOLIDAY_ITEMS'       => '',
        ];

        $expected = new Item(
            'P55232',
            3529,
            'CARREFOUR MARKET',
            'RUE DE LA CROIX AUX POTIERS',
            '',
            '',
            '',
            '35131',
            'CHARTRES DE BRETAGNE',
            -1.7122,
            48.046550,
            '',
            'full'
        );
        $expected->addOpeningHour(new OpeningHour(1, '08:30', '12:00'));
        $expected->addOpeningHour(new OpeningHour(1, '12:00', '20:00'));

        $actual = (new ItemDenormalizer())->denormalize($input, ListResponse::class);

        $this->assertEquals($expected, $actual);
    }
}

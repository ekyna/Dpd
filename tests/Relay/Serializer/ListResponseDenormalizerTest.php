<?php

namespace Ekyna\Component\Dpd\Test\Relay\Serializer;

use Ekyna\Component\Dpd\Relay\Model\Item;
use Ekyna\Component\Dpd\Relay\Model\OpeningHour;
use Ekyna\Component\Dpd\Relay\Response\ListResponse;
use Ekyna\Component\Dpd\Relay\Serializer\ItemDenormalizer;
use Ekyna\Component\Dpd\Relay\Serializer\ListResponseDenormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ListResponseDenormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ListResponseDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $input = [
            '@quality'   => 1,
            'REQUEST_ID' => 'foobar',
            'PUDO_ITEMS' => [
                'PUDO_ITEM' => [
                    [
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
                    ],
                ],
            ],
        ];


        $expected = new ListResponse(1, 'foobar');
        $expected->addItem(
            (new Item(
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
            ))
            ->addOpeningHour(new OpeningHour(1, '08:30', '12:00'))
            ->addOpeningHour(new OpeningHour(1, '12:00', '20:00'))
        );

        $denormalizer = new ListResponseDenormalizer();
        $denormalizer->setDenormalizer(new Serializer([new ItemDenormalizer()]));

        $actual = $denormalizer->denormalize($input, ListResponse::class);

        $this->assertEquals($expected, $actual);
    }
}

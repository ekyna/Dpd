<?php

namespace Ekyna\Component\Dpd\Test\Relay;

use Ekyna\Component\Dpd\Factory;
use Ekyna\Component\Dpd\Relay;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class ApiTest
 * @package Ekyna\Component\Dpd\Test\Relay
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ApiTest extends TestCase
{
    /**
     * @var MockObject|Relay\Client
     */
    private $client;

    /**
     * @var Relay\Api
     */
    private $api;


    protected function setUp(): void
    {
        $this->client = $this->createMock(Relay\Client::class);

        $this->api = new Relay\Api($this->client, Factory::createValidator(), Factory::createSerializer());
    }

    protected function tearDown(): void
    {
        $this->api = null;
        $this->client = null;
    }

    public function testListRelayPoints(): void
    {
        $request = new Relay\Request\ListRequest();
        $request
            ->setAddress('32 rue de rennes')
            ->setZipCode('35230')
            ->setCity('Noyal-Châtillon-sur-Seiche')
            ->setCountryCode('fr')
            ->setRequestId('foo')
            ->setDate(new \DateTime('2020-01-01'))
            ->setWeight(2);

        /** @noinspection CheckTagEmptyBody */
        $this->configureClient(
            'GetPudoList',
            [
                'address'             => '32 rue de rennes',
                'zipCode'             => '35230',
                'city'                => 'Noyal-Châtillon-sur-Seiche',
                'requestID'           => 'foo',
                'date_from'           => '01/01/2020',
                'weight'              => '2',
                'countrycode'         => 'fr',
                'max_pudo_number'     => '',
                'max_distance_search' => '',
                'category'            => '',
                'holiday_tolerant'    => '',
            ],
            <<<XML
<?xml version="1.0" encoding="utf-8"?>
<RESPONSE quality="1">
  <REQUEST_ID>foobar</REQUEST_ID>
  <PUDO_ITEMS>
    <PUDO_ITEM active="true">
      <PUDO_ID>P55232</PUDO_ID>
      <DISTANCE>3529</DISTANCE>
      <NAME>CARREFOUR MARKET</NAME>
      <ADDRESS1>RUE DE LA CROIX AUX POTIERS</ADDRESS1>
      <ADDRESS2></ADDRESS2>
      <ADDRESS3></ADDRESS3>
      <LOCAL_HINT></LOCAL_HINT>
      <ZIPCODE>35131</ZIPCODE>
      <CITY>CHARTRES DE BRETAGNE</CITY>
      <LONGITUDE>-1,7122</LONGITUDE>
      <LATITUDE>48,046550</LATITUDE>
      <MAP_URL></MAP_URL>
      <AVAILABLE>full</AVAILABLE>
      <OPENING_HOURS_ITEMS>
        <OPENING_HOURS_ITEM>
          <DAY_ID>1</DAY_ID>
          <START_TM>08:30</START_TM>
          <END_TM>12:00</END_TM>
        </OPENING_HOURS_ITEM>
        <OPENING_HOURS_ITEM>
          <DAY_ID>1</DAY_ID>
          <START_TM>12:00</START_TM>
          <END_TM>20:00</END_TM>
        </OPENING_HOURS_ITEM>
      </OPENING_HOURS_ITEMS>
      <HOLIDAY_ITEMS />
    </PUDO_ITEM>
  </PUDO_ITEMS>
</RESPONSE>
XML
        );

        $actual = $this->api->getList($request);

        $item = new Relay\Model\Item(
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

        $item
            ->addOpeningHour(new Relay\Model\OpeningHour(1, '08:30', '12:00'))
            ->addOpeningHour(new Relay\Model\OpeningHour(1, '12:00', '20:00'));

        $expected = new Relay\Response\ListResponse(1, 'foobar');
        $expected->addItem($item);

        $this->assertEquals($expected, $actual);
    }

    public function testRelayPointDetails(): void
    {
        $request = new Relay\Request\DetailRequest('P55232');


        /** @noinspection CheckTagEmptyBody */
        $this->configureClient(
            'GetPudoDetails',
            [
                'pudo_id' => 'P55232',
            ],
            <<<XML
<?xml version="1.0" encoding="utf-8"?>
<RESPONSE>
  <PUDO_ITEMS>
    <PUDO_ITEM active="true">
      <PUDO_ID>P32805</PUDO_ID>
      <NAME>VISION PLUS</NAME>
      <ADDRESS1>RUE DE LA FORET</ADDRESS1>
      <ADDRESS2>CC DU BOCAGE</ADDRESS2>
      <ADDRESS3></ADDRESS3>
      <LOCATION_HINT>CCAL CARR MARKET LE BOCAGE</LOCATION_HINT>
      <ZIPCODE>35235</ZIPCODE>
      <CITY>THORIGNE FOUILLARD</CITY>
      <LONGITUDE>-1,580833333330</LONGITUDE>
      <LATITUDE>48,1586111111</LATITUDE>
      <OPENING_HOURS_ITEMS>
        <OPENING_HOURS_ITEM>
          <DAY_ID>1</DAY_ID>
          <START_TM>09:00</START_TM>
          <END_TM>13:00</END_TM>
        </OPENING_HOURS_ITEM>
        <OPENING_HOURS_ITEM>
          <DAY_ID>1</DAY_ID>
          <START_TM>14:30</START_TM>
          <END_TM>19:30</END_TM>
        </OPENING_HOURS_ITEM>
      </OPENING_HOURS_ITEMS>
    </PUDO_ITEM>
  </PUDO_ITEMS>
</RESPONSE>
XML
        );

        $actual = $this->api->getDetails($request);

        $item = new Relay\Model\Item(
            'P32805',
            0,
            'VISION PLUS',
            'RUE DE LA FORET',
            'CC DU BOCAGE',
            '',
            'CCAL CARR MARKET LE BOCAGE',
            '35235',
            'THORIGNE FOUILLARD',
            -1.580833333330,
            48.1586111111,
            '',
            ''
        );

        $item
            ->addOpeningHour(new Relay\Model\OpeningHour(1, '09:00', '13:00'))
            ->addOpeningHour(new Relay\Model\OpeningHour(1, '14:30', '19:30'));

        $expected = new Relay\Response\DetailResponse();
        $expected->setItem($item);

        $this->assertEquals($expected, $actual);
    }

    /**
     * Configures the client mock.
     *
     * @param string $path
     * @param array  $request
     * @param string $response
     */
    private function configureClient(string $path, array $request, string $response): void
    {
        $this
            ->client
            ->expects($this->once())
            ->method('call')
            ->with($path, $request)
            ->willReturn($response);
    }
}

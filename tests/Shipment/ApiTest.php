<?php

namespace Ekyna\Component\Dpd\Test\Shipment;

use Ekyna\Component\Dpd\Factory;
use Ekyna\Component\Dpd\Shipment\Api;
use Ekyna\Component\Dpd\Shipment\Client;
use Ekyna\Component\Dpd\Shipment\Model;
use Ekyna\Component\Dpd\Shipment\Request;
use Ekyna\Component\Dpd\Shipment\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class ApiTest
 * @package Ekyna\Component\Dpd\Test\Shipment
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ApiTest extends TestCase
{
    /**
     * @var MockObject|Client
     */
    private $client;

    /**
     * @var Api
     */
    private $api;


    protected function setUp(): void
    {
        $this->client = $this->createMock(Client::class);

        $credentials = (new Model\Credentials())
            ->setPayerId(12345678)
            ->setPayerAddressId(13456789)
            ->setSenderId(12345678)
            ->setSenderAddressId(13456789)
            ->setSenderZipCode("77144")
            ->setSenderCountryCode("FR")
            ->setDepartureUnitId("1077");

        $this->api = new Api($this->client, $credentials, Factory::createValidator(), Factory::createSerializer());
    }

    protected function tearDown(): void
    {
        $this->api = null;
        $this->client = null;
    }

    public function testCreateShipment(): void
    {
        $receiver = new Model\Address();
        $receiver
            ->setName("Consignee Company Name")
            ->setFirstName("First Name")
            ->setLastName("Last Name")
            ->setHouseNumber("777")
            ->setStreet("Street name")
            ->setStreetInfo("Additional street info")
            ->setZipCode("13140")
            ->setCity("MIRAMAS")
            ->setCountryCode("FR")
            ->setPhoneNumber("+33155443100")
            ->setMobileNumber("+33612345678")
            ->setEmail("consignee@email.fr")
            ->setCode1("1234A")
            ->setCode2("5678B")
            ->setIntercom("Intercom")
            ->setAdditionalInfo("Delivery instructions");

        $parcel = new Model\Parcel();
        $parcel
            ->setCref1("SenderRef1")
            ->setCref2("SenderRef2")
            ->setCref3("SenderRef3")
            ->setCref4("SenderRef4")
            ->setHinsAmount(666)
            ->setWeight(2);

        $request = new Request\ShipmentRequest();
        $request
            ->setShipmentDate(new \DateTime("2019-11-08"))
            ->setReceiver($receiver)
            ->setParcelShopId("parcelShopId")
            ->addParcel($parcel);

        $this->configureClient(
            'shipment/save/ext',
            '{
    "shipmentDate": "20191108",
    "replaceSender": false,
    "parcelShopId": "parcelShopId",
    "returnType": null,
    "sameReturnAddress": true,
    "mps": false,
    "parcels": [
        {
            "cref1": "SenderRef1",
            "cref2": "SenderRef2",
            "cref3": "SenderRef3",
            "cref4": "SenderRef4",
            "hinsAmount": 666,
            "weight": 2
        }
    ],
    "products": {
        "productId": 1
    },
    "payerId": 12345678,
    "payerAddressId": 13456789,
    "senderId": 12345678,
    "senderAddressId": 13456789,
    "departureUnitId": "1077",
    "senderZipCode": "77144",
    "senderCountryCode": "FR",
    "receiverFirmName": "Consignee Company Name",
    "receiverFirstName": "First Name",
    "receiverLastName": "Last Name",
    "receiverHouseNo": "777",
    "receiverStreet": "Street name",
    "receiverStreetInfo": "Additional street info",
    "receiverZipCode": "13140",
    "receiverCity": "MIRAMAS",
    "receiverCountryCode": "FR",
    "receiverLandlineNumber": "+33155443100",
    "receiverMobileNumber": "+33612345678",
    "receiverEmailAddress": "consignee@email.fr",
    "receiverCode1": "1234A",
    "receiverCode2": "5678B",
    "receiverIntercom": "Intercom",
    "receiverAdditionalAdrInfo": "Delivery instructions"
}',
            [144566527]
        );

        $actual = $this->api->createShipment($request);

        $expected = new Response\ShipmentResponse(["144566527"]);

        $this->assertEquals($expected, $actual);
    }

    public function testCreateShipmentWithLabel(): void
    {
        $receiver = new Model\Address();
        $receiver
            ->setName("Consignee Company Name")
            ->setFirstName("First Name")
            ->setLastName("Last Name")
            ->setHouseNumber("777")
            ->setStreet("Street name")
            ->setStreetInfo("Additional street info")
            ->setZipCode("13140")
            ->setCity("MIRAMAS")
            ->setCountryCode("FR")
            ->setPhoneNumber("+33155443100")
            ->setMobileNumber("+33612345678")
            ->setEmail("consignee@email.fr")
            ->setCode1("1234A")
            ->setCode2("5678B")
            ->setIntercom("Intercom")
            ->setAdditionalInfo("Delivery instructions");

        $parcel = new Model\Parcel();
        $parcel
            ->setCref1("SenderRef1")
            ->setCref2("SenderRef2")
            ->setCref3("SenderRef3")
            ->setCref4("SenderRef4")
            ->setHinsAmount(666)
            ->setWeight(2);

        $request = new Request\ShipmentWithLabelRequest();
        $request
            ->setShipmentDate(new \DateTime("2019-11-08"))
            ->setReceiver($receiver)
            ->setParcelShopId("parcelShopId")
            ->addParcel($parcel)
            ->setManifest(new Model\Manifest());

        $this->configureClient(
            'shipment/save/print',
            '{
    "shipmentDate": "20191108",
    "replaceSender": false,
    "parcelShopId": "parcelShopId",
    "returnType": null,
    "sameReturnAddress": true,
    "mps": false,
    "parcels": [
        {
            "cref1": "SenderRef1",
            "cref2": "SenderRef2",
            "cref3": "SenderRef3",
            "cref4": "SenderRef4",
            "hinsAmount": 666,
            "weight": 2
        }
    ],
    "products": {
        "productId": 1
    },
    "payerId": 12345678,
    "payerAddressId": 13456789,
    "senderId": 12345678,
    "senderAddressId": 13456789,
    "departureUnitId": "1077",
    "senderZipCode": "77144",
    "senderCountryCode": "FR",
    "receiverFirmName": "Consignee Company Name",
    "receiverFirstName": "First Name",
    "receiverLastName": "Last Name",
    "receiverHouseNo": "777",
    "receiverStreet": "Street name",
    "receiverStreetInfo": "Additional street info",
    "receiverZipCode": "13140",
    "receiverCity": "MIRAMAS",
    "receiverCountryCode": "FR",
    "receiverLandlineNumber": "+33155443100",
    "receiverMobileNumber": "+33612345678",
    "receiverEmailAddress": "consignee@email.fr",
    "receiverCode1": "1234A",
    "receiverCode2": "5678B",
    "receiverIntercom": "Intercom",
    "receiverAdditionalAdrInfo": "Delivery instructions",
    "manifest": {
        "labelFormat": "A6",
        "referenceAsBarcode": false,
        "language": "fr",
        "fileType": "PDF",
        "dpi": 203
    }
}',
            [
                "shipments" => [
                    [
                        "shpId"          => 170905211,
                        "parcels"        => ["10770941407312"],
                        "manifestId"     => 159880,
                        "returnShpId"    => null,
                        "masterParcelId" => null,
                        "returnParcels"  => null,
                    ],
                ],
                "label"     => [
                    "fileContent" => "TEFCRUxfUERGX0NPTlRFTlQ=",
                    "fileName"    => "web_label1001377120190510_17582693.pdf",
                    "fileType"    => "PDF",
                ],
            ]
        );

        $actual = $this->api->createShipmentWithLabel($request);

        $expected = new Response\ShipmentWithLabelResponse(
            [
                new Model\Shipment(
                    ["10770941407312"],
                    170905211,
                    null,
                    159880,
                    null,
                    null
                ),
            ],
            new Model\Label('web_label1001377120190510_17582693.pdf', 'LABEL_PDF_CONTENT', 'PDF')
        );

        $this->assertEquals($expected, $actual);
    }

    public function testGetLabel(): void
    {
        $request = new Request\GetLabelRequest();
        $request
            ->setLabelStartPosition(1)
            ->setLabelFormat(Model\Formats::A6)
            ->setReferenceAsBarcode(false)
            ->setLanguage("fr")
            ->setShpIdList(["144566527", "144566528"])
            ->setFileType(Model\FileTypes::PDF)
            ->setDpi(Model\Dpi::DPI_203);

        $this->configureClient(
            'manifest/label4web/print/close/download',
            '{
    "labelFormat": "A6",
    "referenceAsBarcode": false,
    "language": "fr",
    "fileType": "PDF",
    "dpi": 203,
    "labelStartPosition": 1,
    "shpIdList": ["144566527","144566528"]
}',
            [
                "shipments" => [
                    [
                        "shpId"          => 170905241,
                        "parcels"        => ["10770941407314"],
                        "manifestId"     => 159881,
                        "returnShpId"    => 170905242,
                        "masterParcelId" => null,
                        "returnParcels"  => ["10770941407315"],
                    ],
                ],
                "label"     => [
                    "fileContent" => "TEFCRUxfUERGX0NPTlRFTlQ=",
                    "fileName"    => "web_label1001377320190510_18010930.pdf",
                    "fileType"    => "PDF",
                ],
            ]
        );

        $actual = $this->api->getLabel($request);

        $expected = new Response\ShipmentWithLabelResponse(
            [
                new Model\Shipment(
                    ["10770941407314"],
                    170905241,
                    170905242,
                    159881,
                    null,
                    ["10770941407315"]
                ),
            ],
            new Model\Label('web_label1001377320190510_18010930.pdf', 'LABEL_PDF_CONTENT', Model\FileTypes::PDF)
        );

        $this->assertEquals($expected, $actual);
    }

    public function testReprintLabel(): void
    {
        $request = new Request\ReprintLabelRequest();
        $request
            ->setLabelStartPosition(1)
            ->setLabelFormat(Model\Formats::A4)
            ->setReferenceAsBarcode(false)
            ->setLanguage("fr")
            ->setParcelNumber("10770941396534")
            ->setFileType(Model\FileTypes::PDF)
            ->setDpi(Model\Dpi::DPI_203);

        $this->configureClient(
            'manifest/label4web/reprint/download',
            '{
    "labelFormat": "A4",
    "referenceAsBarcode": false,
    "language": "fr",
    "fileType": "PDF",
    "dpi": 203,
    "labelStartPosition": 1,
    "parcelNumber":"10770941396534"
}',
            [
                "fileContent" => "TEFCRUxfUERGX0NPTlRFTlQ=",
                "fileName"    => "web_label1001377020190510_17575109.pdf",
                "fileType"    => "PDF",
            ]);

        $actual = $this->api->reprintLabel($request);

        $expected = new Response\ReprintLabelResponse(
            'web_label1001377020190510_17575109.pdf',
            'LABEL_PDF_CONTENT',
            Model\FileTypes::PDF
        );

        $this->assertEquals($expected, $actual);
    }

    public function testReturnOnDemand(): void
    {
        $request = new Request\ReturnOnDemandRequest();
        $request
            ->setLabelStartPosition(1)
            ->setLabelFormat(Model\Formats::A4)
            ->setReferenceAsBarcode(false)
            ->setLanguage("fr")
            ->setParcelNumber("10770941193251")
            ->setFileType(Model\FileTypes::PDF)
            ->setDpi(Model\Dpi::DPI_203);

        $this->configureClient(
            'shipment/print/return-on-demand',
            '{
    "labelFormat": "A4",
    "referenceAsBarcode": false,
    "language": "fr",
    "fileType": "PDF",
    "dpi": 203,
    "labelStartPosition": 1,
    "parcelNumber":"10770941193251"
}',
            [
                "shpId"      => 170905212,
                "parcels"    => ["10770941407313"],
                "manifestId" => null,
                "label"      => [
                    "fileContent" => "TEFCRUxfUERGX0NPTlRFTlQ=",
                    "fileName"    => "web_label1001377220190510_17583292.pdf",
                    "fileType"    => "PDF",
                ],
            ]);

        $actual = $this->api->returnOnDemand($request);

        $expected = new Response\ReturnOnDemandResponse(
            ["10770941407313"],
            new Model\Label('web_label1001377220190510_17583292.pdf', 'LABEL_PDF_CONTENT', Model\FileTypes::PDF),
            170905212,
            null
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCreatePickupOrder(): void
    {
        $request = new Request\CreatePickupOrderRequest();
        $request
            ->setContactPerson("John Doe")
            ->setFromDate(new \DateTime("2020-01-01 10:00:00"))
            ->setToDate(new \DateTime("2020-01-01 14:00:00"));

        $this->configureClient(
            'call-pools/save',
            '{
    "payerId": 12345678,
    "payerAddressId": 13456789,
    "senderId": 12345678,
    "senderAddressId": 13456789,
    "senderZipCode": "77144",
    "senderCountryCode": "FR",
    "reqChannel": "E",
    "callType": "01",
    "contactPerson": "John Doe",
    "desiredPickUpDate": "20200101",
    "desiredPickUpTime1": "100000",
    "desiredPickUpTime2": "140000"
}',
            [
                "callId"          => 8654746,
                "responseMessage" => "Pickup request created.",
                "coreInfoMessage" => 80256,
            ]);

        $actual = $this->api->createPickupOrder($request);

        $expected = new Response\PickupOrderResponse(
            8654746,
            "Pickup request created.",
            "80256"
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCancelPickupOrder(): void
    {
        $request = new Request\CancelPickupOrderRequest();
        $request->setCallId(7542844);

        $this->configureClient(
            'deletion-shipments/pickup-orders-with-related-shipments',
            '{"callId": 7542844}',
            [
                "callId"          => 8459002,
                "responseMessage" => "OK",
                "coreInfoMessage" => null,
            ]);

        $actual = $this->api->cancelPickupOrder($request);

        $expected = new Response\PickupOrderResponse(
            8459002,
            "OK",
            null
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCreateCollectionRequest(): void
    {
        $request = new Request\CreateCollectionRequest();
        $request
            ->setWeight(2)
            ->setDesiredPickupDate($date = new \DateTime('+1 day'));

        $request
            ->getPickupAddress()
            ->setName("Company Name")
            ->setFirstName("First Name")
            ->setLastName("Last Name")
            ->setHouseNumber("777")
            ->setStreet("Street name")
            ->setStreetInfo("Additional street info")
            ->setZipCode("13140")
            ->setCity("MIRAMAS")
            ->setCountryCode("FR")
            ->setPhoneNumber("+33155443100")
            ->setMobileNumber("+33612345678")
            ->setEmail("consignee@email.fr")
            ->setCode1("1234A")
            ->setCode2("5678B")
            ->setIntercom("Intercom")
            ->setAdditionalInfo("Delivery instructions");

        $request
            ->getDeliveryAddress()
            ->setName("Company Name")
            ->setFirstName("First Name")
            ->setLastName("Last Name")
            ->setStreet("Street name")
            ->setZipCode("13140")
            ->setCity("MIRAMAS")
            ->setCountryCode("FR")
            ->setPhoneNumber("+33155443100");

        $this->configureClient(
            'collection-request/save/ext',
            '{
  "reqChannel": "E",
  "custref": "12345678",
  "weight": 2.0,
  "parcelCount": 1,
  "desiredPickupDate": "' . $date->format('Ymd') . '",
  "cname": "Company Name",
  "cname2": "First Name Last Name",
  "chouseNo": "777",
  "cstreet": "Street name",
  "cstreetInfo": "Additional street info",
  "cpostal": "13140",
  "ccity": "MIRAMAS",
  "ccountry": "FR",
  "cphone": "+33155443100",
  "cphone2": "+33612345678",
  "cemail": "consignee@email.fr",
  "ccode1": "1234A",
  "ccode2": "5678B",
  "cintercom": "Intercom",
  "cadditionalAddressText": "Delivery instructions",
  "rname": "Company Name",
  "rname2": "First Name Last Name",
  "rhouseNo": null,
  "rstreet": "Street name",
  "rstreetInfo": null,
  "rpostal": "13140",
  "rcity": "MIRAMAS",
  "rcountry": "FR",
  "rphone": "+33155443100",
  "rphone2": null,
  "remail": null,
  "rcode1": null,
  "rcode2": null,
  "rintercom": null,
  "radditionalAddressText": null
}',
            [
                "coreInfoMessageId" => 50,
                "colReqId"          => 679919,
                "callId"            => 8654750,
                "ordernr"           => 634671,
                "oid"               => "031966ujt7cw5u8u",
                "timeCreate"        => "170109",
                "dateCreate"        => "20190313",
                "userCreate"        => "YOUR_LOGIN",
                "odepot"            => "1013",
                "rdepot"            => "1095",
                "cdepot"            => "1077",
                "parcelNo"          => "10130387136922",
                "masterCallId"      => null,
            ]);

        $actual = $this->api->createCollectionRequest($request);

        $expected = new Response\CreateCollectionResponse(
            50,
            679919,
            8654750,
            634671,
            "031966ujt7cw5u8u",
            new \DateTime("2019-03-13 17:01:09"),
            "YOUR_LOGIN",
            "1013",
            "1095",
            "1077",
            "10130387136922",
            null
        );

        $this->assertEquals($expected, $actual);
    }

    public function testCancelCollectionRequest(): void
    {
        $request = new Request\CancelCollectionRequest();
        $request->setParcelNumber(10130387136922);

        $this->configureClient(
            'collection-request/cancel',
            '{"callId": null, "parcelNumber": 10130387136922}',
            [
                "reqStatus"      => "OK",
                "transferStatus" => null,
            ]);

        $actual = $this->api->cancelCollectionRequest($request);

        $expected = new Response\CancelCollectionResponse(
            "OK",
            null
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * Configures the client mock.
     *
     * @param string $path
     * @param string $body
     * @param array  $response
     */
    private function configureClient(string $path, string $body, array $response): void
    {
        $this
            ->client
            ->expects($this->once())
            ->method('call')
            ->with($path, json_encode(json_decode($body)))
            ->willReturn($response);
    }
}

<?php

namespace Ekyna\Component\Dpd\Test\Serializer;

use Ekyna\Component\Dpd\Shipment\Model;
use Ekyna\Component\Dpd\Shipment\Request\ShipmentRequest;
use Ekyna\Component\Dpd\Shipment\Serializer\AddressNormalizer;
use Ekyna\Component\Dpd\Shipment\Serializer\CredentialsNormalizer;
use Ekyna\Component\Dpd\Shipment\Serializer\ParcelNormalizer;
use Ekyna\Component\Dpd\Shipment\Serializer\ShipmentRequestNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ShipmentRequestNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentRequestNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $credentials = new Model\Credentials();
        $credentials
            ->setPayerId(12)
            ->setPayerAddressId(34)
            ->setSenderId(56)
            ->setSenderAddressId(78)
            ->setDepartureUnitId("departureUnitId")
            ->setSenderZipCode("senderZipCode")
            ->setSenderCountryCode("senderCountryCode");

        $receiver = new Model\Address();
        $receiver
            ->setName("firmName")
            ->setFirstName("firstName")
            ->setLastName("lastName")
            ->setHouseNumber("houseNo")
            ->setStreet("street")
            ->setStreetInfo("streetInfo")
            ->setZipCode("zipCode")
            ->setCity("city")
            ->setCountryCode("countryCode")
            ->setPhoneNumber("phoneNumber")
            ->setMobileNumber("mobileNumber")
            ->setEmail("emailAddress")
            ->setCode1("code1")
            ->setCode2("code2")
            ->setIntercom("intercom")
            ->setAdditionalInfo("additionalAdrInfo");

        $sender = new Model\Address();
        $sender
            ->setName("senderAddress")
            ->setHouseNumber("buildingNo")
            ->setStreet("street")
            ->setStreetInfo("streetInfo")
            ->setZipCode("zipCode")
            ->setCity("cityName")
            ->setCountryCode("countryCode")
            ->setPhoneNumber("telNo");

        $returnAddress = new Model\Address();
        $returnAddress
            ->setName("returnAddress")
            ->setHouseNumber("buildingNo")
            ->setStreet("street")
            ->setStreetInfo("streetInfo")
            ->setZipCode("zipCode")
            ->setCity("cityName")
            ->setCountryCode("countryCode")
            ->setPhoneNumber("telNo");

        $parcel = new Model\Parcel();
        $parcel
            ->setCref1("cref1")
            ->setCref2("cref2")
            ->setCref3("cref3")
            ->setCref4("cref4")
            ->setHinsAmount(2000)
            ->setWeight(12.5);

        $model = new ShipmentRequest();
        $model
            ->setShipmentDate(new \DateTime("2019-11-08"))
            ->setCredentials($credentials)
            ->setReceiver($receiver)
            ->setReplaceSender(true)
            ->setReplaceSenderAddress($sender)
            ->setParcelShopId("parcelShopId")
            ->setReturnType(Model\ReturnTypes::ON_DEMAND)
            ->setSameReturnAddress(false)
            ->setReturnAddress($returnAddress)
            ->setMps(true)
            ->addParcel($parcel)
            ->setProduct(Model\Products::CLASSIC);

        $expected = [
            "shipmentDate"              => "20191108",
            // Credentials
            "payerId"                   => 12,
            "payerAddressId"            => 34,
            "senderId"                  => 56,
            "senderAddressId"           => 78,
            "departureUnitId"           => "departureUnitId",
            "senderZipCode"             => "senderZipCode",
            "senderCountryCode"         => "senderCountryCode",
            // Receiver
            "receiverFirmName"          => "firmName",
            "receiverFirstName"         => "firstName",
            "receiverLastName"          => "lastName",
            "receiverHouseNo"           => "houseNo",
            "receiverStreet"            => "street",
            "receiverStreetInfo"        => "streetInfo",
            "receiverZipCode"           => "zipCode",
            "receiverCity"              => "city",
            "receiverCountryCode"       => "countryCode",
            "receiverLandlineNumber"    => "phoneNumber",
            "receiverMobileNumber"      => "mobileNumber",
            "receiverEmailAddress"      => "emailAddress",
            "receiverCode1"             => "code1",
            "receiverCode2"             => "code2",
            "receiverIntercom"          => "intercom",
            "receiverAdditionalAdrInfo" => "additionalAdrInfo",
            "replaceSender"             => true,
            "replaceSenderAddress"      => [
                "name"        => "senderAddress",
                "buildingNo"  => "buildingNo",
                "street"      => "street",
                "streetInfo"  => "streetInfo",
                "zipCode"     => "zipCode",
                "cityName"    => "cityName",
                "countryCode" => "countryCode",
                "telNo"       => "telNo",
            ],
            "parcelShopId"              => "parcelShopId",
            "returnType"                => 1,
            "sameReturnAddress"         => false,
            "returnAddress"             => [
                "name"        => "returnAddress",
                "buildingNo"  => "buildingNo",
                "street"      => "street",
                "streetInfo"  => "streetInfo",
                "zipCode"     => "zipCode",
                "cityName"    => "cityName",
                "countryCode" => "countryCode",
                "telNo"       => "telNo",
            ],
            "mps"                       => true,
            "parcels"                   => [
                [
                    "cref1"      => "cref1",
                    "cref2"      => "cref2",
                    "cref3"      => "cref3",
                    "cref4"      => "cref4",
                    "hinsAmount" => 2000,
                    "weight"     => 12.5,
                ],
            ],
            "products"                  => [
                "productId" => 1,
            ],
        ];

        $serializer = new Serializer([
            new CredentialsNormalizer(),
            new AddressNormalizer(),
            new ParcelNormalizer(),
        ]);

        $normalizer = new ShipmentRequestNormalizer();
        $normalizer->setNormalizer($serializer);

        $actual = $normalizer->normalize($model, 'json');

        $this->assertEquals($expected, $actual);
    }
}

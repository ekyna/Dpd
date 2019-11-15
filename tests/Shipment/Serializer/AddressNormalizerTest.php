<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Address;
use Ekyna\Component\Dpd\Shipment\Model\AddressTypes;
use Ekyna\Component\Dpd\Shipment\Serializer\AddressNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class AddressNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class AddressNormalizerTest extends TestCase
{
    public function testNormalizeDefault(): void
    {
        $expected = [
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
        ];

        $this->normalize($expected);
        $this->normalize($expected, AddressTypes::RECEIVER);
    }

    public function testNormalizeSenderOrReturn(): void
    {
        $expected = [
            "name"        => "firmName",
            "buildingNo"  => "houseNo",
            "street"      => "street",
            "streetInfo"  => "streetInfo",
            "zipCode"     => "zipCode",
            "cityName"    => "city",
            "countryCode" => "countryCode",
            "telNo"       => "phoneNumber",
        ];

        $this->normalize($expected, AddressTypes::SENDER);
        $this->normalize($expected, AddressTypes::RETURN);
    }

    public function testNormalizePickup(): void
    {
        $expected = [
            "cname"                  => "firmName",
            "cname2"                 => "firstName lastName",
            "chouseNo"               => "houseNo",
            "cstreet"                => "street",
            "cstreetInfo"            => "streetInfo",
            "cpostal"                => "zipCode",
            "ccity"                  => "city",
            "ccountry"               => "countryCode",
            "cphone"                 => "phoneNumber",
            "cphone2"                => "mobileNumber",
            "cemail"                 => "emailAddress",
            "ccode1"                 => "code1",
            "ccode2"                 => "code2",
            "cintercom"              => "intercom",
            "cadditionalAddressText" => "additionalAdrInfo",
        ];

        $this->normalize($expected, AddressTypes::PICKUP);
    }

    public function testNormalizeDelivery(): void
    {
        $expected = [
            "rname"                  => "firmName",
            "rname2"                 => "firstName lastName",
            "rhouseNo"               => "houseNo",
            "rstreet"                => "street",
            "rstreetInfo"            => "streetInfo",
            "rpostal"                => "zipCode",
            "rcity"                  => "city",
            "rcountry"               => "countryCode",
            "rphone"                 => "phoneNumber",
            "rphone2"                => "mobileNumber",
            "remail"                 => "emailAddress",
            "rcode1"                 => "code1",
            "rcode2"                 => "code2",
            "rintercom"              => "intercom",
            "radditionalAddressText" => "additionalAdrInfo",
        ];

        $this->normalize($expected, AddressTypes::DELIVERY);
    }

    private function normalize(array $expected, string $type = null): void
    {
        $normalizer = new AddressNormalizer();

        $actual = $normalizer->normalize($this->createAddress(), 'json', $type ? ['type' => $type] : []);

        $this->assertEquals($expected, $actual);
    }

    private function createAddress(): Address
    {
        $model = new Address();
        $model
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

        return $model;
    }
}

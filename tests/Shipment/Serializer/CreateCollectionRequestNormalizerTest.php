<?php

namespace Ekyna\Component\Dpd\Test\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\CreateCollectionRequest;
use Ekyna\Component\Dpd\Shipment\Serializer\AddressNormalizer;
use Ekyna\Component\Dpd\Shipment\Serializer\CreateCollectionRequestNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Serializer;

/**
 * Class CreateCollectionRequestNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreateCollectionRequestNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $model = new CreateCollectionRequest();
        $model
            ->setCustref(123456789)
            ->setWeight(2)
            ->setDesiredPickupDate($date = new \DateTime('2020-01-01'));

        $model
            ->getPickupAddress()
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

        $model
            ->getDeliveryAddress()
            ->setName("firmName")
            ->setStreet("street")
            ->setZipCode("zipCode")
            ->setCity("city")
            ->setCountryCode("countryCode")
            ->setPhoneNumber("phoneNumber");

        $expected = [
            "reqChannel"             => "E",
            "custref"                => "123456789",
            "weight"                 => 2.0,
            "parcelCount"            => 1,
            "desiredPickupDate"      => "20200101",
            // Pickup
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
            // Delivery
            "rname"                  => "firmName",
            "rname2"                 => null,
            "rhouseNo"               => null,
            "rstreet"                => "street",
            "rstreetInfo"            => null,
            "rpostal"                => "zipCode",
            "rcity"                  => "city",
            "rcountry"               => "countryCode",
            "rphone"                 => "phoneNumber",
            "rphone2"                => null,
            "remail"                 => null,
            "rcode1"                 => null,
            "rcode2"                 => null,
            "rintercom"              => null,
            "radditionalAddressText" => null,
        ];

        $serializer = new Serializer([
            new AddressNormalizer(),
        ]);

        $normalizer = new CreateCollectionRequestNormalizer();
        $normalizer->setNormalizer($serializer);

        $actual = $normalizer->normalize($model, 'json');

        $this->assertEquals($expected, $actual);
    }
}

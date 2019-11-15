<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Credentials;
use Ekyna\Component\Dpd\Shipment\Request\CreatePickupOrderRequest;
use Ekyna\Component\Dpd\Shipment\Serializer\CreatePickupOrderRequestNormalizer;
use Ekyna\Component\Dpd\Shipment\Serializer\CredentialsNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Serializer;

/**
 * Class CreatePickupOrderRequestNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreatePickupOrderRequestNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $credentials = new Credentials();
        $credentials
            ->setPayerId(12)
            ->setPayerAddressId(34)
            ->setSenderId(56)
            ->setSenderAddressId(78)
            ->setDepartureUnitId("departureUnitId")
            ->setSenderZipCode("senderZipCode")
            ->setSenderCountryCode("senderCountryCode");

        $request = new CreatePickupOrderRequest();
        $request
            ->setCredentials($credentials)
            ->setContactPerson("John Doe")
            ->setFromDate(new \DateTime("2020-01-01 10:00:00"))
            ->setToDate(new \DateTime("2020-01-01 14:00:00"));

        $expected = [
            "payerId"            => 12,
            "payerAddressId"     => 34,
            "senderId"           => 56,
            "senderAddressId"    => 78,
            "senderZipCode"      => "senderZipCode",
            "senderCountryCode"  => "senderCountryCode",
            "reqChannel"         => "E",
            "callType"           => "01",
            "contactPerson"      => "John Doe",
            "desiredPickUpDate"  => "20200101",
            "desiredPickUpTime1" => "100000",
            "desiredPickUpTime2" => "140000",
        ];

        $serializer = new Serializer([new CredentialsNormalizer()]);

        $denormalizer = new CreatePickupOrderRequestNormalizer();
        $denormalizer->setNormalizer($serializer);

        $actual = $denormalizer->normalize($request, 'json');

        $this->assertEquals($expected, $actual);
    }
}

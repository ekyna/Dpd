<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Credentials;
use Ekyna\Component\Dpd\Shipment\Serializer\CredentialsNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class CredentialsNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CredentialsNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $model = new Credentials();
        $model
            ->setPayerId(12)
            ->setPayerAddressId(34)
            ->setSenderId(56)
            ->setSenderAddressId(78)
            ->setDepartureUnitId("departureUnitId")
            ->setSenderZipCode("senderZipCode")
            ->setSenderCountryCode("senderCountryCode");

        $expected = [
            "payerId"           => 12,
            "payerAddressId"    => 34,
            "senderId"          => 56,
            "senderAddressId"   => 78,
            "departureUnitId"   => "departureUnitId",
            "senderZipCode"     => "senderZipCode",
            "senderCountryCode" => "senderCountryCode",
        ];

        $actual = (new CredentialsNormalizer())->normalize($model, 'json');

        $this->assertEquals($expected, $actual);
    }
}

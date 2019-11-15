<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\CancelPickupOrderRequest;
use Ekyna\Component\Dpd\Shipment\Serializer\CancelPickupOrderRequestNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class CancelPickupOrderNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CancelPickupOrderNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $model = new CancelPickupOrderRequest();
        $model
            ->setCallId(123456789);

        $expected = [
            "callId" => "123456789",
        ];

        $actual = (new CancelPickupOrderRequestNormalizer())->normalize($model, 'json');

        $this->assertEquals($expected, $actual);
    }
}

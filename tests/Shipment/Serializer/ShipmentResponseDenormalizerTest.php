<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Response\ShipmentResponse;
use Ekyna\Component\Dpd\Shipment\Serializer\ShipmentResponseDenormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class ShipmentResponseDenormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentResponseDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $input = [
            'tempShpId' => ["144566527"],
        ];

        $expected = new ShipmentResponse(["144566527"]);

        $actual = (new ShipmentResponseDenormalizer())->denormalize($input, ShipmentResponse::class);

        $this->assertEquals($expected, $actual);
    }
}

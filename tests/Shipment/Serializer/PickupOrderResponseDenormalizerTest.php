<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Response\PickupOrderResponse;
use Ekyna\Component\Dpd\Shipment\Response\ShipmentWithLabelResponse;
use Ekyna\Component\Dpd\Shipment\Serializer\PickupOrderResponseDenormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class PickupOrderResponseDenormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class PickupOrderResponseDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $input = [
            "callId"          => 8654746,
            "responseMessage" => "Pickup request created.",
            "coreInfoMessage" => 80256,
        ];

        $expected = new PickupOrderResponse(
            8654746,
            "Pickup request created.",
            "80256"
        );

        $actual = (new PickupOrderResponseDenormalizer())->denormalize($input, ShipmentWithLabelResponse::class);

        $this->assertEquals($expected, $actual);
    }
}

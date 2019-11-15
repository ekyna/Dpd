<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Response\CancelCollectionResponse;
use Ekyna\Component\Dpd\Shipment\Serializer\CancelCollectionResponseDenormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class CancelCollectionResponseDenormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CancelCollectionResponseDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $input = [
            "reqStatus" => "OK",
            "transferStatus" => null,
        ];

        $expected = new CancelCollectionResponse(
            "OK",
            null
        );

        $actual = (new CancelCollectionResponseDenormalizer())->denormalize($input, CancelCollectionResponse::class);

        $this->assertEquals($expected, $actual);
    }
}

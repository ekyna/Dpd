<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\CancelCollectionRequest;
use Ekyna\Component\Dpd\Shipment\Serializer\CancelCollectionRequestNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class CancelCollectionRequestNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CancelCollectionRequestNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $request = new CancelCollectionRequest();
        $request->setParcelNumber(10130387136922);

        $expected = [
            "callId"       => null,
            "parcelNumber" => 10130387136922,
        ];

        $denormalizer = new CancelCollectionRequestNormalizer();

        $actual = $denormalizer->normalize($request, 'json');

        $this->assertEquals($expected, $actual);
    }
}

<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Response\CreateCollectionResponse;
use Ekyna\Component\Dpd\Shipment\Serializer\CreateCollectionResponseDenormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class CreateCollectionResponseDenormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreateCollectionResponseDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $input = [
            [
                "coreInfoMessageId" => 50,
                "colReqId"          => 679919,
                "callId"            => 8654750,
                "ordernr"           => 634671,
                "oid"               => "031966ujt7cw5u8u",
                "timeCreate"        => "170109",
                "dateCreate"        => "20190313",
                "userCreate"        => "YOUR_LOGIN",
                "odepot"            => "1013",
                "rdepot"            => "1095",
                "cdepot"            => "1077",
                "parcelNo"          => "10130387136922",
                "masterCallId"      => null,
            ],
        ];

        $expected = new CreateCollectionResponse(
            50,
            679919,
            8654750,
            634671,
            "031966ujt7cw5u8u",
            new \DateTime("2019-03-13 17:01:09"),
            "YOUR_LOGIN",
            "1013",
            "1095",
            "1077",
            "10130387136922",
            null
        );

        $actual = (new CreateCollectionResponseDenormalizer())->denormalize($input, CreateCollectionResponse::class);

        $this->assertEquals($expected, $actual);
    }
}

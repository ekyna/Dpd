<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Request\GetLabelRequest;
use Ekyna\Component\Dpd\Shipment\Serializer\GetLabelRequestNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class GetLabelRequestNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class GetLabelRequestNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $model = new GetLabelRequest();
        $model->setShpIdList(["123456"]);

        $expected = [
            "labelStartPosition" => 1,
            "shpIdList"          => ["123456"],
            "labelFormat"        => "A6",
            "referenceAsBarcode" => false,
            "language"           => "fr",
            "fileType"           => "PDF",
            "dpi"                => 203,
        ];

        $actual = (new GetLabelRequestNormalizer())->normalize($model, 'json');

        $this->assertEquals($expected, $actual);
    }
}

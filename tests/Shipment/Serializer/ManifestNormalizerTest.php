<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Manifest;
use Ekyna\Component\Dpd\Shipment\Serializer\ManifestNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class ManifestNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ManifestNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $model = new Manifest();

        $expected = [
            "labelFormat"        => "A6",
            "referenceAsBarcode" => false,
            "language"           => "fr",
            "fileType"           => "PDF",
            "dpi"                => 203,
        ];

        $actual = (new ManifestNormalizer())->normalize($model, 'json');

        $this->assertEquals($expected, $actual);
    }
}

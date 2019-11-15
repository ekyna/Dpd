<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Parcel;
use Ekyna\Component\Dpd\Shipment\Serializer\ParcelNormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class ParcelNormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ParcelNormalizerTest extends TestCase
{
    public function testNormalize(): void
    {
        $model = new Parcel();
        $model
            ->setCref1("cref1")
            ->setCref2("cref2")
            ->setCref3("cref3")
            ->setCref4("cref4")
            ->setHinsAmount(2000)
            ->setWeight(10.5);

        $expected = [
            "cref1"      => "cref1",
            "cref2"      => "cref2",
            "cref3"      => "cref3",
            "cref4"      => "cref4",
            "hinsAmount" => 2000,
            "weight"     => 10.5,
        ];

        $actual = (new ParcelNormalizer())->normalize($model, 'json');

        $this->assertEquals($expected, $actual);
    }
}

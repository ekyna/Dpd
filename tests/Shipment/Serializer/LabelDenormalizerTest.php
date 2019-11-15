<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\FileTypes;
use Ekyna\Component\Dpd\Shipment\Model\Label;
use Ekyna\Component\Dpd\Shipment\Serializer\LabelDenormalizer;
use PHPUnit\Framework\TestCase;

/**
 * Class LabelDenormalizer
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class LabelDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $input = [
            'fileName'    => 'test.pdf',
            'fileContent' => base64_encode('TEST'),
            'fileType'    => 'PDF',
        ];

        $expected = new Label('test.pdf', 'TEST', FileTypes::PDF);

        $actual = (new LabelDenormalizer())->denormalize($input, Label::class);

        $this->assertEquals($expected, $actual);
    }
}

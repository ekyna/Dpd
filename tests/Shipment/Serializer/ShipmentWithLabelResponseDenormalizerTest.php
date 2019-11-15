<?php

namespace Ekyna\Component\Dpd\Test\Shipment\Serializer;

use Ekyna\Component\Dpd\Shipment\Model\Label;
use Ekyna\Component\Dpd\Shipment\Model\Shipment;
use Ekyna\Component\Dpd\Shipment\Response\ShipmentWithLabelResponse;
use Ekyna\Component\Dpd\Shipment\Serializer\LabelDenormalizer;
use Ekyna\Component\Dpd\Shipment\Serializer\ShipmentDenormalizer;
use Ekyna\Component\Dpd\Shipment\Serializer\ShipmentWithLabelResponseDenormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ShipmentWithLabelResponseDenormalizerTest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentWithLabelResponseDenormalizerTest extends TestCase
{
    public function testDenormalize(): void
    {
        $input = [
            'shipments' => [
                [
                    'shpId'          => 144561759,
                    'manifestId'     => 158032,
                    'returnShpId'    => null,
                    'masterParcelId' => '10770941396524',
                    'parcels'        => ["10770941396524"],
                    'returnParcels'  => null,
                ],
            ],
            'label'     => [
                'fileName'    => 'labels.pdf',
                'fileContent' => base64_encode('CONTENT'),
                'fileType'    => 'PDF',
            ],
        ];

        $denormalizer = new ShipmentWithLabelResponseDenormalizer();
        $denormalizer->setDenormalizer(new Serializer([new LabelDenormalizer(), new ShipmentDenormalizer()]));

        $expected = new ShipmentWithLabelResponse(
            [
                new Shipment(
                    ["10770941396524"],
                    144561759,
                    null,
                    158032,
                    10770941396524,
                    null
                ),
            ],
            new Label('labels.pdf', 'CONTENT', 'PDF')
        );

        $actual = $denormalizer->denormalize($input, ShipmentWithLabelResponse::class);

        $this->assertEquals($expected, $actual);
    }
}

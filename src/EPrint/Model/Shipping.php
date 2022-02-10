<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;

/**
 * Class Shipping
 * @package Ekyna\Component\Dpd\EPrint\Model
 * @author  Étienne Dauvergne <contact@ekyna.com>
 *
 * @property string  $shipment
 * @property int     $barcodeSource
 * @property string  $barcodeId
 * @property string  $weight
 * @property Address $receiverAddress
 * @property string  $reference
 */
class Shipping extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('shipment', true, 255))
            ->addField(new Definition\Numeric('barcodeSource', false, 255))
            ->addField(new Definition\AlphaNumeric('barcodeId', false, 255))
            ->addField(new Definition\Decimal('weight', true, 6, 2))
            ->addField(new Definition\Model('receiverAddress', false, Address::class))
            ->addField(new Definition\AlphaNumeric('reference', false, 255));
    }
}

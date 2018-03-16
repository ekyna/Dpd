<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Model\ReverseInverseServices;
use Ekyna\Component\Dpd\Model\ShipmentRequestBase;

/**
 * Class CreateReverseInverseShipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ReverseShipmentRequest extends ShipmentRequestBase
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\Decimal('weigth', false, 6, 2))
            ->addField(new Definition\Numeric('expire_offset', true, 3))
            ->addField(new Definition\AlphaNumeric('referencenumber', false, 35))
            ->addField(new Definition\Model('services', false, ReverseInverseServices::class));
    }
}
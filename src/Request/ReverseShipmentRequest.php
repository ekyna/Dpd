<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Request;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Model\ReverseInverseServices;
use Ekyna\Component\DpdWs\Model\ShipmentRequestBase;

/**
 * Class CreateReverseInverseShipment
 * @package Ekyna\Component\DpdWs
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
            ->addField(new Definition\Object('services', false, ReverseInverseServices::class));
    }
}

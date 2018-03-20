<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Model\ShipmentRequestDefaultData;

/**
 * Class StdShipmentRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $weight          Poids (kg)
 * @property string $referencenumber Référence interne 1
 * @property string $reference2      Référence interne 2
 * @property string $reference3      Référence interne 3
 */
class StdShipmentRequest extends ShipmentRequestDefaultData
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\Decimal('weight', true, 6, 2))
            ->addField(new Definition\AlphaNumeric('referencenumber', false, 35))
            ->addField(new Definition\AlphaNumeric('reference2', false, 35))
            ->addField(new Definition\AlphaNumeric('reference3', false, 35));
    }
}

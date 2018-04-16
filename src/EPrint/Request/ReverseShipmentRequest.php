<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model;

/**
 * Class CreateReverseInverseShipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string                       $weight          Poids
 * @property string                       $expire_offset   Délai de validité (jours, min 7)
 * @property string                       $referencenumber Référence interne 1
 * @property Model\ReverseInverseServices $services        Services
 */
class ReverseShipmentRequest extends Model\ShipmentRequestBase
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
            ->addField(new Definition\Model('services', false, Model\ReverseInverseServices::class));
    }
}

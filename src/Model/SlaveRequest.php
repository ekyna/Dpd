<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class SlaveRequest
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $weight          Poids
 * @property string $referencenumber Référence interne 1
 * @property string $reference2      Référence interne 2
 * @property string $reference3      Référence interne 3
 * @property string $services
 */
class SlaveRequest extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\Decimal('weigth', false, 6, 2))
            ->addField(new Definition\AlphaNumeric('referencenumber', false, 35))
            ->addField(new Definition\AlphaNumeric('reference2', false, 35))
            ->addField(new Definition\AlphaNumeric('reference3', false, 35))
            ->addField(new Definition\Object('services', false, SlaveServices::class));
    }
}

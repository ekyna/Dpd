<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;

/**
 * Class SlaveRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $weight          Poids
 * @property string $referencenumber Référence interne 1
 * @property string $reference2      Référence interne 2
 * @property string $reference3      Référence interne 3
 * @property string $services
 */
class SlaveRequest extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Decimal('weigth', false, 6, 2))
            ->addField(new Definition\AlphaNumeric('referencenumber', false, 35))
            ->addField(new Definition\AlphaNumeric('reference2', false, 35))
            ->addField(new Definition\AlphaNumeric('reference3', false, 35))
            ->addField(new Definition\Model('services', false, SlaveServices::class));
    }
}

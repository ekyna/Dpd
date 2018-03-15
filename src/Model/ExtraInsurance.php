<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Enum\ETypeInsurance;

/**
 * Class ExtraInsurance
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $value Montant de la valeur déclarée
 * @property string $type  Type de valeur déclarée
 *
 * @see \Ekyna\Component\DpdWs\Enum\ETypeInsurance
 */
class ExtraInsurance extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('value', false, 35))
            ->addField(new Definition\Enum('type', true, ETypeInsurance::class));
    }
}

<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Enum\ETypeConsolidation;

/**
 * Class Consolidation
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $type
 *
 * @see ETypeConsolidation
 */
class Consolidation extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Enum('type', true, ETypeConsolidation::class));
    }
}
<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Enum\ELabelType;

/**
 * Class LabelType
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $type PNG / PDF / PDF_A6
 *
 * @see ELabelType
 */
class LabelType extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Enum('type', true, ELabelType::class));
    }
}

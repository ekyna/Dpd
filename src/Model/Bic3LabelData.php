<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Enum\EBic3Mode;

/**
 * Class Bic3LabelData
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $mode
 */
class Bic3LabelData extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Enum('mode', true, EBic3Mode::class));
    }
}

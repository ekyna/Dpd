<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Enum\EType;

/**
 * Class Label
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $type  Type d'étiquette
 * @property string $label Etiquette sous forme de Bytearrays
 *
 * @see EType
 */
class Label extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Enum('type', true, EType::class))
            ->addField(new Definition\AlphaNumeric('label', false, 3));
    }
}

<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Enum\EType;

/**
 * Class Label
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $type  Type d'étiquette
 * @property string $label Etiquette sous forme de Bytearrays
 *
 * @see EType
 */
class Label extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Enum('type', true, EType::class))
            ->addField(new Definition\AlphaNumeric('label', false, 3)); // TODO base64Binary / bytesArray
    }
}

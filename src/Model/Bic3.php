<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class Bic3
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $type
 */
class Bic3 extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Boolean('generateBic3', true));
    }
}

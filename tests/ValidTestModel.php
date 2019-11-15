<?php

namespace Ekyna\Component\Dpd\Test;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;

/**
 * Class ValidTestModel
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $test
 */
class ValidTestModel extends AbstractInput
{
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Boolean('test', true));
    }
}

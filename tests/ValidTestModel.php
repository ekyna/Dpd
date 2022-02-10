<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\Tests;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition\Boolean;
use Ekyna\Component\Dpd\Definition\Definition;

/**
 * Class ValidTestModel
 * @package Ekyna\Component\Dpd
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class ValidTestModel extends AbstractInput
{
    protected function buildDefinition(Definition $definition): void
    {
        $definition->addField(new Boolean('test', true));
    }
}

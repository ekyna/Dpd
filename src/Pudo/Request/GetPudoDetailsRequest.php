<?php

namespace Ekyna\Component\Dpd\Pudo\Request;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\RequestInterface;

/**
 * Class GetPudoDetailsRequest
 * @package Ekyna\Component\Dpd\Pudo
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $pudo_id
 */
class GetPudoDetailsRequest extends AbstractInput implements RequestInterface
{
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\AlphaNumeric('pudo_id', true, 10));
    }
}

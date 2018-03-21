<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\AbstractInput;

/**
 * Class SlaveServices
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property ExtraInsurance $extraInsurance Valeur déclarée
 */
class SlaveServices extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Model('extraInsurance', false, ExtraInsurance::class));
    }
}

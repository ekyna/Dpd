<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class SlaveServices
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property ExtraInsurance $extraInsurance Valeur déclarée
 */
class SlaveServices extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Object('extraInsurance', false, ExtraInsurance::class));
    }
}

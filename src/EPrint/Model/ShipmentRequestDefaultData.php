<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\Definition;

/**
 * Class ShipmentRequestDefaultData
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property StdServices $services
 */
class ShipmentRequestDefaultData extends ShipmentRequestBase
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition->addField(new Definition\Model('services', false, StdServices::class));
    }
}

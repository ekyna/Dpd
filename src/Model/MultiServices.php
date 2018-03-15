<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class MultiServices
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Consolidation $consolidation Consolidation déclarative
 * @property Contact       $contact
 * @property PickupData    $pickupAtCustomer
 */
class MultiServices extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Object('consolidation', false, Consolidation::class))
            ->addField(new Definition\Object('contact', false, Contact::class))
            ->addField(new Definition\Object('pickupAtCustomer', false, PickupData::class));
    }
}

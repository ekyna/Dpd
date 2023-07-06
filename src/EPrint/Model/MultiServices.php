<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;

/**
 * Class MultiServices
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Consolidation $consolidation Consolidation déclarative
 * @property Contact       $contact
 * @property PickupData    $pickupAtCustomer
 */
class MultiServices extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Model('consolidation', false, Consolidation::class))
            ->addField(new Definition\Model('contact', false, Contact::class))
            ->addField(new Definition\Model('pickupAtCustomer', false, PickupData::class));
    }
}

<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Request;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Model;

/**
 * Class MultiShipmentRequest
 * @package Ekyna\Component\DpdWs\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Model\MultiServices        $services
 * @property Model\Contact              $contact
 * @property array|Model\SlaveRequest[] $slaves
 */
class MultiShipmentRequest extends Model\ShipmentRequestBase
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\Object('services', false, Model\MultiServices::class))
            ->addField(new Definition\Object('contact', false, Model\Contact::class))
            ->addField(new Definition\ArrayOfObjects('slaves', false, Model\SlaveRequest::class));
    }
}

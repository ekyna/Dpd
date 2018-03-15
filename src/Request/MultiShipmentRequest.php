<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Model;

/**
 * Class MultiShipmentRequest
 * @package Ekyna\Component\Dpd\Model
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
            ->addField(new Definition\Model('services', false, Model\MultiServices::class))
            ->addField(new Definition\Model('contact', false, Model\Contact::class))
            ->addField(new Definition\ArrayOfModel('slaves', false, Model\SlaveRequest::class));
    }
}

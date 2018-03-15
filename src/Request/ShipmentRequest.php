<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Model;

/**
 * Class ShipmentRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Model\Parcel  $parcel
 * @property Model\Contact $contact
 */
class ShipmentRequest extends Model\AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Model('parcel', true, Model\Parcel::class))
            ->addField(new Definition\Model('customer', true, Model\Customer::class));
    }
}

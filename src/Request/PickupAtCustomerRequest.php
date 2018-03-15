<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Request;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Model;

/**
 * Class PickupAtCustomerRequest
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Model\Address        $shipperaddress        Adresse expéditeur
 * @property Model\Customer       $customer              Client
 * @property string               $pick_date             Date d'enlèvement jj.mm.aaaa
 * @property Model\PickupData     $data                  Données optionnelles
 * @property array|Model\Parcel[] $shipments
 */
class PickupAtCustomerRequest extends Model\AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Object('shipperaddress', true, Model\Address::class))
            ->addField(new Definition\Object('customer', true, Model\Customer::class))
            ->addField(new Definition\AlphaNumeric('pick_date', true, 10))
            ->addField(new Definition\Object('data', false, Model\PickupData::class))
            ->addField(new Definition\ArrayOfObjects('shipments', false, Model\Parcel::class));
    }
}

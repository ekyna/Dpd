<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Model;

/**
 * Class PickupAtCustomerRequest
 * @package Ekyna\Component\Dpd
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
            ->addField(new Definition\Model('shipperaddress', true, Model\Address::class))
            ->addField(new Definition\Model('customer', true, Model\Customer::class))
            ->addField(new Definition\Date('pick_date', true))
            ->addField(new Definition\Model('data', false, Model\PickupData::class))
            ->addField(new Definition\ArrayOfModel('shipments', false, Model\Parcel::class));
    }
}
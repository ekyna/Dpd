<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\Definition;

/**
 * Class StdServices
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property ExtraInsurance       $extraInsurance
 * @property Contact              $contact
 * @property ParcelShop           $parcelshop
 * @property Reverse              $reverse
 * @property ReverseInverseReturn $reverseInverseReturn
 * @property AutoConsolidation    $autoConsolidation
 * @property PickupData           $pickupAtCustomer
 * @property Bic3                 $bic3
 * @property Sameday              $sameday
 */
class StdServices extends StdServicesBase
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\Model('extraInsurance', false, ExtraInsurance::class))
            ->addField(new Definition\Model('contact', false, Contact::class))
            ->addField(new Definition\Model('parcelshop', false, ParcelShop::class))
            ->addField(new Definition\Model('reverse', false, Reverse::class))
            ->addField(new Definition\Model('reverseInverseReturn', false, ReverseInverseReturn::class))
            ->addField(new Definition\Model('autoConsolidation', false, AutoConsolidation::class))
            ->addField(new Definition\Model('pickupAtCustomer', false, PickupData::class))
            ->addField(new Definition\Model('bic3', false, Bic3::class))
            ->addField(new Definition\Model('sameday', false, Sameday::class));
    }
}

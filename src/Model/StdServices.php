<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class StdServices
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property ExtraInsurance       $extraInsurance
 * @property Contact              $contact
 * @property ParcelShop           $parcelShop
 * @property Reverse              $reverse
 * @property ReverseInverseReturn $reverseInverseReturn
 * @property AutoConsolidation    $autoConsolidation
 * @property Bic3                 $bic3
 */
class StdServices extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Object('extraInsurance', false, ExtraInsurance::class))
            ->addField(new Definition\Object('contact', false, Contact::class))
            ->addField(new Definition\Object('parcelShop', false, ParcelShop::class))
            ->addField(new Definition\Object('reverse', false, Reverse::class))
            ->addField(new Definition\Object('reverseInverseReturn', false, ReverseInverseReturn::class))
            ->addField(new Definition\Object('autoConsolidation', false, AutoConsolidation::class))
            ->addField(new Definition\Object('bic3', false, Bic3::class));
    }
}

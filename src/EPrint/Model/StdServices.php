<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\AbstractInput;

/**
 * Class StdServices
 * @package Ekyna\Component\Dpd
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
class StdServices extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Model('extraInsurance', false, ExtraInsurance::class))
            ->addField(new Definition\Model('contact', false, Contact::class))
            ->addField(new Definition\Model('parcelShop', false, ParcelShop::class))
            ->addField(new Definition\Model('reverse', false, Reverse::class))
            ->addField(new Definition\Model('reverseInverseReturn', false, ReverseInverseReturn::class))
            ->addField(new Definition\Model('autoConsolidation', false, AutoConsolidation::class))
            ->addField(new Definition\Model('bic3', false, Bic3::class));
    }
}

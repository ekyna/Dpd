<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model\Address;
use Ekyna\Component\Dpd\EPrint\Model\Bic3LabelData;
use Ekyna\Component\Dpd\EPrint\Model\ReferenceInBarcode;

/**
 * Class StdShipmentLabelRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Bic3LabelData      $bic3data
 * @property Address            $overrideShipperLabelAddress
 * @property ReferenceInBarcode $referenceInBarcode
 * @property bool               $refnrasbarcode
 */
class StdShipmentLabelRequest extends StdShipmentLabelBaseRequest
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\Model('bic3data', false, Bic3LabelData::class))
            ->addField(new Definition\Model('overrideShipperLabelAddress', false, Address::class))
            ->addField(new Definition\Model('referenceInBarcode', false, ReferenceInBarcode::class))
            ->addField(new Definition\Boolean('refnrasbarcode', false));
    }
}

<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model;
use Ekyna\Component\Dpd\RequestInterface;

/**
 * Class ShipmentRequestBc
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string         $Barcode
 * @property string         $BarcodeSource
 * @property string         $BarcodeId
 * @property Model\Customer $customer
 */
class ShipmentRequestBc extends AbstractInput implements RequestInterface
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('Barcode', false, 255))
            ->addField(new Definition\AlphaNumeric('BarcodeSource', false, 255))
            ->addField(new Definition\AlphaNumeric('BarcodeId', false, 255))
            ->addField(new Definition\Model('customer', true, Model\Customer::class));
    }
}

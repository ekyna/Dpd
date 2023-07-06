<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model;
use Ekyna\Component\Dpd\RequestInterface;

/**
 * Class ShipmentRequest
 * @package    Ekyna\Component\Dpd
 * @author     Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Model\Parcel   $parcel
 * @property Model\Customer $customer
 *
 * @deprecated Use ShipmentRequestBc (GetShipmentBC api method)
 */
class ShipmentRequest extends AbstractInput implements RequestInterface
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

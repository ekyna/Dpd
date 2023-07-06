<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\ShipmentRequest;

/**
 * Class GetShipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated Use GetShipmentBC method.
 */
class GetShipment extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'GetShipment';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return ShipmentRequest::class;
    }
}

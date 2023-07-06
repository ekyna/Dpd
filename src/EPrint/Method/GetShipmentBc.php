<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\ShipmentRequestBc;

/**
 * Class GetShipmentBc
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetShipmentBc extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'GetShipmentBc';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return ShipmentRequestBc::class;
    }
}

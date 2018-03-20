<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Request;

/**
 * Class GetShipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetShipment extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName()
    {
        return 'GetShipment';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass()
    {
        return Request\ShipmentRequest::class;
    }
}

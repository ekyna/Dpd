<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Request;

/**
 * Class CreateReverseInverseShipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateReverseInverseShipment extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName()
    {
        return 'CreateReverseInverseShipment';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass()
    {
        return Request\ReverseShipmentRequest::class;
    }
}

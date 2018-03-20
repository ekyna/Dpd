<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Request;

/**
 * Class CreateMultiShipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateMultiShipment extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName()
    {
        return 'CreateMultiShipment';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass()
    {
        return Request\MultiShipmentRequest::class;
    }
}

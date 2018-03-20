<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Request;

/**
 * Class CreateShipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateShipment extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName()
    {
        return 'CreateShipment';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass()
    {
        return Request\StdShipmentRequest::class;
    }
}

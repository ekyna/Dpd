<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\StdShipmentRequest;

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
    protected function getMethodName(): string
    {
        return 'CreateShipment';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return StdShipmentRequest::class;
    }
}

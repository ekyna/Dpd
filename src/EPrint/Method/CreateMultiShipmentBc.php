<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\MultiShipmentRequest;

/**
 * Class CreateMultiShipmentBc
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateMultiShipmentBc extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'CreateMultiShipmentBc';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return MultiShipmentRequest::class;
    }
}

<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\StdShipmentLabelRequest;

/**
 * Class CreateShipmentWithLabelsBc
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateShipmentWithLabelsBc extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'CreateShipmentWithLabelsBc';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return StdShipmentLabelRequest::class;
    }
}

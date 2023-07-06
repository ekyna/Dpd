<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\ReverseShipmentLabelRequest;

/**
 * Class CreateReverseInverseShipmentWithLabelsBc
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateReverseInverseShipmentWithLabelsBc extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'CreateReverseInverseShipmentWithLabelsBc';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return ReverseShipmentLabelRequest::class;
    }
}

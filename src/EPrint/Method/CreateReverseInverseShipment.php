<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\ReverseShipmentRequest;

/**
 * Class CreateReverseInverseShipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated Use CreateReverseInverseShipmentBc method.
 */
class CreateReverseInverseShipment extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'CreateReverseInverseShipment';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return ReverseShipmentRequest::class;
    }
}

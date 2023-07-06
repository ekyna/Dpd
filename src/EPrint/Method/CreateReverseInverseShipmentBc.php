<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\ReverseShipmentRequest;

/**
 * Class CreateReverseInverseShipmentBc
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateReverseInverseShipmentBc extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'CreateReverseInverseShipmentBc';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return ReverseShipmentRequest::class;
    }
}

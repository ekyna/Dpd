<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\GetShippingRequest;

/**
 * Class GetShipping
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetShipping extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'GetShipping';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return GetShippingRequest::class;
    }
}

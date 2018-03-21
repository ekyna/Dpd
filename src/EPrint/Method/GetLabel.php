<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\ReceiveLabelRequest;

/**
 * Class GetLabel
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetLabel extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'GetLabel';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return ReceiveLabelRequest::class;
    }
}

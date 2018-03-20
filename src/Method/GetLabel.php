<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Request;

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
    protected function getMethodName()
    {
        return 'GetLabel';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass()
    {
        return Request\ReceiveLabelRequest::class;
    }
}

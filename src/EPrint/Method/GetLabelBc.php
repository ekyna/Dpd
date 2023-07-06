<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\ReceiveLabelBcRequest;

/**
 * Class GetLabelBc
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetLabelBc extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'GetLabelBc';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return ReceiveLabelBcRequest::class;
    }
}

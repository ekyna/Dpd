<?php

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\TerminateCollectionRequestRequest;

/**
 * Class TerminateCollectionRequest
 * @package Ekyna\Component\Dpd\EPrint\Method
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class TerminateCollectionRequest extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'TerminateCollectionRequest';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return TerminateCollectionRequestRequest::class;
    }
}

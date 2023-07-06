<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\TerminateCollectionRequestBcRequest;

/**
 * Class TerminateCollectionRequestBc
 * @package Ekyna\Component\Dpd\EPrint\Method
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class TerminateCollectionRequestBc extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'TerminateCollectionRequestBc';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return TerminateCollectionRequestBcRequest::class;
    }
}

<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\CollectionRequestRequest;

/**
 * Class CreateCollectionRequestBc
 * @package Ekyna\Component\Dpd\EPrint\Method
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateCollectionRequestBc extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'CreateCollectionRequestBc';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return CollectionRequestRequest::class;
    }
}

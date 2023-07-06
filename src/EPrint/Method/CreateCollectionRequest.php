<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\CollectionRequestRequest;

/**
 * Class CreateCollectionRequest
 * @package Ekyna\Component\Dpd\EPrint\Method
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated Use CreateCollectionRequestBc
 */
class CreateCollectionRequest extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'CreateCollectionRequest';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return CollectionRequestRequest::class;
    }
}

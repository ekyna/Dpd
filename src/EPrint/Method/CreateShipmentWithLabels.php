<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\StdShipmentLabelRequest;

/**
 * Class CreateShipmentWithLabels
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated Use CreateShipmentWithLabelsBc method.
 */
class CreateShipmentWithLabels extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'CreateShipmentWithLabels';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return StdShipmentLabelRequest::class;
    }
}

<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Request\ReverseShipmentLabelRequest;

/**
 * Class CreateReverseInverseShipmentWithLabels
 * @package    Ekyna\Component\Dpd
 * @author     Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated Use CreateReverseInverseShipmentWithLabelsBc method.
 */
class CreateReverseInverseShipmentWithLabels extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName(): string
    {
        return 'CreateReverseInverseShipmentWithLabels';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass(): string
    {
        return ReverseShipmentLabelRequest::class;
    }
}

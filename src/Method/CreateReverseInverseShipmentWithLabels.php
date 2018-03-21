<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Request;

/**
 * Class CreateReverseInverseShipmentWithLabels
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateReverseInverseShipmentWithLabels extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName()
    {
        return 'CreateReverseInverseShipmentWithLabels';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass()
    {
        return Request\ReverseShipmentLabelRequest::class;
    }
}

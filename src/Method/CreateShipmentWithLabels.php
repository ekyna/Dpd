<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Request;

/**
 * Class CreateShipmentWithLabels
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateShipmentWithLabels extends AbstractMethod
{
    /**
     * @inheritdoc
     */
    protected function getMethodName()
    {
        return 'CreateShipmentWithLabels';
    }

    /**
     * @inheritdoc
     */
    protected function getRequestClass()
    {
        return Request\StdShipmentLabelRequest::class;
    }
}

<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class GetShipmentResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated
 */
class GetShipmentResponse implements ResponseInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\ShipmentDataExtended
     */
    public $GetShipmentResult;
}

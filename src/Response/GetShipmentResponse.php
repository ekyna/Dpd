<?php

namespace Ekyna\Component\Dpd\Response;

use Ekyna\Component\Dpd\Model;

/**
 * Class GetShipmentResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetShipmentResponse implements ResponseInterface
{
    /**
     * @var Model\ShipmentDataExtended
     */
    public $GetShipmentResult;
}

<?php

namespace Ekyna\Component\Dpd\Response;

/**
 * Class GetShipmentResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetShipmentResponse implements ResponseInterface
{
    /**
     * @var \Ekyna\Component\Dpd\Model\ShipmentDataExtended
     */
    public $GetShipmentResult;
}

<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\EPrint\Model\ShipmentBc;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateReverseInverseShipmentBcResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateReverseInverseShipmentBcResponse implements ResponseInterface
{
    /**
     * @var ShipmentBc
     */
    public $CreateReverseInverseShipmentBcResult;
}

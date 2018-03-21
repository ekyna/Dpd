<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateReverseInverseShipmentResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateReverseInverseShipmentResponse implements ResponseInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\Shipment
     */
    public $CreateReverseInverseShipmentResult;
}

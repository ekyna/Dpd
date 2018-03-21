<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateReverseInverseShipmentWithLabelsResponse
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateReverseInverseShipmentWithLabelsResponse implements ResponseInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\ShipmentWithLabels
     */
    public $CreateReverseInverseShipmentWithLabelsResult;
}

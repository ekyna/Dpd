<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Response;

/**
 * Class CreateReverseInverseShipmentWithLabelsResponse
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateReverseInverseShipmentWithLabelsResponse implements ResponseInterface
{
    /**
     * @var \Ekyna\Component\Dpd\Model\ShipmentWithLabels
     */
    public $CreateReverseInverseShipmentWithLabelsResult;
}
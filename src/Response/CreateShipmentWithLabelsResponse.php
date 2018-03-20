<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Response;

use Ekyna\Component\Dpd\Model\OutputInterface;

/**
 * Class ShipmentWithLabelsResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateShipmentWithLabelsResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var \Ekyna\Component\Dpd\Model\ShipmentsWithLabels
     */
    public $CreateShipmentWithLabelsResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->CreateShipmentWithLabelsResult) {
            $this->CreateShipmentWithLabelsResult->initialize();
        }
    }
}

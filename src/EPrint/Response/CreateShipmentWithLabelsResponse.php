<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class ShipmentWithLabelsResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateShipmentWithLabelsResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\ShipmentsWithLabels
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

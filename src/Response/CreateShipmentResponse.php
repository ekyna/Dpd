<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Response;

use Ekyna\Component\Dpd\Model\ArrayOfShipment;
use Ekyna\Component\Dpd\Model\OutputInterface;

/**
 * Class CreateShipmentResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateShipmentResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var ArrayOfShipment
     */
    public $CreateShipmentResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->CreateShipmentResult) {
            $this->CreateShipmentResult->initialize();
        }
    }
}

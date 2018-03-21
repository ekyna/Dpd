<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateShipmentResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateShipmentResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\ArrayOfShipment
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

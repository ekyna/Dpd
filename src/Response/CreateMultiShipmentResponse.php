<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Response;

use Ekyna\Component\Dpd\Model\OutputInterface;

/**
 * Class CreateMultiShipmentResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateMultiShipmentResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var \Ekyna\Component\Dpd\Model\MultiShipment
     */
    public $CreateMultiShipmentResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->CreateMultiShipmentResult) {
            $this->CreateMultiShipmentResult->initialize();
        }
    }
}

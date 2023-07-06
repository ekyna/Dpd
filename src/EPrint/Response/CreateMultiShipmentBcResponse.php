<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateMultiShipmentBcResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateMultiShipmentBcResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\MultiShipmentBc
     */
    public $CreateMultiShipmentBcResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->CreateMultiShipmentBcResult) {
            $this->CreateMultiShipmentBcResult->initialize();
        }
    }
}

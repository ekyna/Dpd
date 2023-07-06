<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\EPrint\Model\ShipmentWithLabelsBc;
use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateReverseInverseShipmentWithLabelsBcResponse
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CreateReverseInverseShipmentWithLabelsBcResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var ShipmentWithLabelsBc
     */
    public $CreateReverseInverseShipmentWithLabelsBcResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->CreateReverseInverseShipmentWithLabelsBcResult) {
            $this->CreateReverseInverseShipmentWithLabelsBcResult->initialize();
        }
    }
}

<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Response;

use Ekyna\Component\Dpd\OutputInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class CreateReverseInverseShipmentWithLabelsResponse
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated
 */
class CreateReverseInverseShipmentWithLabelsResponse implements ResponseInterface, OutputInterface
{
    /**
     * @var \Ekyna\Component\Dpd\EPrint\Model\ShipmentWithLabels
     */
    public $CreateReverseInverseShipmentWithLabelsResult;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->CreateReverseInverseShipmentWithLabelsResult) {
            $this->CreateReverseInverseShipmentWithLabelsResult->initialize();
        }
    }
}

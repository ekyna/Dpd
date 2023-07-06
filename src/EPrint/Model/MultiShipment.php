<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class MultiShipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated
 */
class MultiShipment implements OutputInterface
{
    /**
     * @var Shipment
     */
    public $mastershipment;

    /**
     * @var ArrayOfShipment
     */
    public $shipments;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->shipments) {
            $this->shipments->initialize();
        }
    }
}

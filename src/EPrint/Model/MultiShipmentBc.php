<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class MultiShipmentBc
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class MultiShipmentBc implements OutputInterface
{
    /**
     * @var ShipmentBc
     */
    public $mastershipment;

    /**
     * @var ArrayOfShipmentBc|iterable<ShipmentBc>
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

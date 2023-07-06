<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class ShipmentWithLabelsBc
 * @package Ekyna\Component\Dpd\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentWithLabelsBc implements OutputInterface
{
    /**
     * Le n° de colis DPD
     *
     * @var ShipmentBc
     */
    public $Shipment;

    /**
     * Le/les étiquette(s) DPD
     *
     * @var ArrayOfLabel
     */
    public $Labels;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->Labels) {
            $this->Labels->initialize();
        }
    }
}

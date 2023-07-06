<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class ShipmentsWithLabelsBc
 * @package Ekyna\Component\Dpd\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentsWithLabelsBc implements OutputInterface
{
    /**
     * Le/les n° de colis DPD
     *
     * @var ArrayOfShipmentBc
     */
    public $shipments;

    /**
     * Le/les étiquette(s) DPD
     *
     * @var ArrayOfLabel
     */
    public $labels;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        $this->shipments->initialize();
        $this->labels->initialize();
    }
}

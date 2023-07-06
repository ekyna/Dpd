<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class ShipmentsWithLabels
 * @package Ekyna\Component\Dpd\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @deprecated
 */
class ShipmentsWithLabels implements OutputInterface
{
    /**
     * Le/les n° de colis DPD
     *
     * @var ArrayOfShipment
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
        if ($this->shipments) {
            $this->shipments->initialize();
        }

        if ($this->labels) {
            $this->labels->initialize();
        }
    }
}

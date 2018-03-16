<?php

namespace Ekyna\Component\Dpd\Model;

/**
 * Class ShipmentsWithLabels
 * @package Ekyna\Component\Dpd\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentsWithLabels
{
    /**
     * Le/les n° de colis DPD
     *
     * @var Shipment[]
     */
    public $shipments;

    /**
     * Le/les étiquette(s) DPD
     *
     * @var Label[]
     */
    public $labels;
}

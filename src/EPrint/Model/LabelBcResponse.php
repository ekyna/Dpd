<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class LabelBcResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class LabelBcResponse implements OutputInterface
{
    /**
     * Le/les étiquette(s) DPD
     *
     * @var ArrayOfLabel
     */
    public $labels;

    /**
     * Le n° de colis DPD
     *
     * @var BcDataExt
     */
    public $shipment;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->labels) {
            $this->labels->initialize();
        }
    }
}

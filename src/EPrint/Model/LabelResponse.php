<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class LabelResponse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property int          $countrycode  Code pays (250 = France)
 * @property int          $centernumber Code agence
 * @property int          $parcelnumber N° de colis
 */
class LabelResponse implements OutputInterface
{
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
        if ($this->labels) {
            $this->labels->initialize();
        }
    }
}
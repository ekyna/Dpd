<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;

/**
 * Class BcDataExt
 * @package Ekyna\Component\Dpd\EPrint\Model
 * @author  Étienne Dauvergne <contact@ekyna.com>
 *
 * @property string $BarCode       Contenu du code à barres DPD.
 * @property string $BarcodeId     Numéro d’expédition.
 * @property string $BarcodeSource Code ISO pays/réseau.
 */
class BcDataExt extends AbstractInput
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('BarCode', true, 255))
            ->addField(new Definition\AlphaNumeric('BarcodeId', true, 255))
            ->addField(new Definition\Numeric('BarcodeSource', true, 255));
    }
}

<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Enum\EType;

/**
 * Class Shipment
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property int $countrycode  Code pays (250 = France)
 * @property int $centernumber Code agence
 * @property int $parcelnumber N° de colis
 * @property int $barcode      Contenu du code à barres DPD
 * @property int $type         Type d’expédition
 */
class Shipment extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Numeric('countrycode', true, 3))
            ->addField(new Definition\Numeric('centernumber', true, 3))
            ->addField(new Definition\Numeric('parcelnumber', true, 9))
            ->addField(new Definition\Numeric('barcode', true, 255)) // TODO limit ?
            ->addField(new Definition\Enum('type', false, EType::class));
    }
}
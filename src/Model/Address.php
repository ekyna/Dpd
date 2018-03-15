<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class Address
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $name          Nom (+ prénom dans le cadre d'une expédition Relais)
 * @property string $phoneNumber   Téléphone
 * @property string $faxNumber     Fax
 * @property string $geoX          Géo-coordonnées X
 * @property string $geoY          Géo-coordonnées Y
 */
class Address extends AddressMini
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\AlphaNumeric('name', false, 35))
            ->addField(new Definition\AlphaNumeric('phoneNumber', false, 30))
            ->addField(new Definition\AlphaNumeric('faxNumber', false, 30))
            ->addField(new Definition\Decimal('geoX', false, 3, 6))
            ->addField(new Definition\Decimal('geoY', false, 3, 6));
    }

    /**
     * @inheritdoc
     */
    public function validate(string $prefix = null): void
    {
        parent::validate($prefix);

        // TODO both or none geoX and GeoY
    }
}

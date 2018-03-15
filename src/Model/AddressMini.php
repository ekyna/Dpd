<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class AddressMini
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $countryPrefix Code pays DPD ou ISO2/3 (France = F | FR | FRA)
 * @property string $zipCode       Code postal
 * @property string $city          Ville
 * @property string $street        Rue
 */
class AddressMini extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('countryPrefix', false, 3))
            ->addField(new Definition\AlphaNumeric('zipCode', false, 10))
            ->addField(new Definition\AlphaNumeric('city', false, 35))
            ->addField(new Definition\AlphaNumeric('street', false, 35));
    }
}

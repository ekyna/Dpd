<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;

/**
 * Class AddressMini
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $countryPrefix Code pays DPD ou ISO2/3 (France = F | FR | FRA)
 * @property string $zipCode       Code postal
 * @property string $city          Ville
 * @property string $street        Rue
 */
class AddressMini extends AbstractInput
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

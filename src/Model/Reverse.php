<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Enum\ETypeReverse;

/**
 * Class Reverse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Address $retour_receiver Adresse de retour
 * @property string  $type            Type de Retour
 * @property int     $expireOffset    Période de validité du retour de colis (en jours)
 *
 * @see ETypeReverse
 */
class Reverse extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Model('retour_receiver', false, Address::class))
            ->addField(new Definition\Numeric('expireOffset', true, 2))
            ->addField(new Definition\Enum('type', true, ETypeReverse::class));
    }
}

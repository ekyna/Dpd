<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\Definition;

/**
 * Class PickupData
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string    $time_from   Optionnel (par défaut : 08:00)
 * @property string    $time_to     Optionnel (par défaut : 18:00)
 * @property string    $remark      Commentaire / livraison
 * @property string    $pick_remark Commentaire / enlèvement - ramasse
 * @property bool|null $dayCheckDone
 */
class PickupData extends AbstractModel
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\AlphaNumeric('time_from', true, 5))
            ->addField(new Definition\AlphaNumeric('time_to', true, 5))
            ->addField(new Definition\AlphaNumeric('remark', true, 35))
            ->addField(new Definition\AlphaNumeric('pick_remark', true, 35))
            ->addField(new Definition\Boolean('dayCheckDone', false)); // TODO nullable
    }
}

<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Request;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Model;

/**
 * Class ReceiveLabelRequest
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property int             $countrycode  Code pays (250 = France)
 * @property int             $centernumber Code agence
 * @property int             $parcelnumber N° de colis
 * @property Model\LabelType $labelType    Type d'étiquette
 */
class ReceiveLabelRequest extends Model\AbstractModel
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
            ->addField(new Definition\Object('labelType', false, Model\LabelType::class));
    }
}

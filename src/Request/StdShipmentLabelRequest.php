<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Request;

use Ekyna\Component\DpdWs\Definition;
use Ekyna\Component\DpdWs\Model\Bic3LabelData;
use Ekyna\Component\DpdWs\Model\LabelType;

/**
 * Class StdShipmentLabelRequest
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string        $customLabelText Commentaire de livraison
 * @property LabelType     $labelType
 * @property Bic3LabelData $bic3data
 * @property bool          $refnrasbarcode
 */
class StdShipmentLabelRequest extends StdShipmentRequest
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\AlphaNumeric('customLabelText', false, 400))
            ->addField(new Definition\Object('labelType', false, LabelType::class))
            ->addField(new Definition\Object('bic3data', false, Bic3LabelData::class))
            ->addField(new Definition\Boolean('refnrasbarcode', false));
    }
}

<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Model\Bic3LabelData;
use Ekyna\Component\Dpd\Model\LabelType;

/**
 * Class StdShipmentLabelRequest
 * @package Ekyna\Component\Dpd
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
            ->addField(new Definition\Model('labelType', false, LabelType::class))
            ->addField(new Definition\Model('bic3data', false, Bic3LabelData::class))
            ->addField(new Definition\Boolean('refnrasbarcode', false));
    }
}

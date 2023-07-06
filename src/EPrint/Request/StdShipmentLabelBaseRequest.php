<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model\LabelType;

/**
 * Class StdShipmentLabelBaseRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string    $customLabelText Commentaire de livraison
 * @property LabelType $labelType
 */
class StdShipmentLabelBaseRequest extends StdShipmentRequest
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\AlphaNumeric('customLabelText', false, 400))
            ->addField(new Definition\Model('labelType', false, LabelType::class));
    }
}

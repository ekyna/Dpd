<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\Model\LabelType;

/**
 * Class ReverseShipmentLabelRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string    $receiver_contact_name
 * @property string    $customLabelText
 * @property LabelType $labelType
 * @property bool      $refasbarcode
 */
class ReverseShipmentLabelRequest extends ReverseShipmentRequest
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        parent::buildDefinition($definition);

        $definition
            ->addField(new Definition\AlphaNumeric('receiver_contact_name', false, 35))// TODO length missing in doc
            ->addField(new Definition\AlphaNumeric('customLabelText', false, 400))
            ->addField(new Definition\Model('labelType', false, LabelType::class))
            ->addField(new Definition\Boolean('refasbarcode', true));
    }
}

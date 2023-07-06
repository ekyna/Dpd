<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model;
use Ekyna\Component\Dpd\RequestInterface;

/**
 * Class ReceiveLabelBcRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property Model\Customer           $customer                       Compte DPD France. Code pays (250 = France).
 * @property string                   $shipmentNumber                 Numéro d’expédition. BarcodeId ou Barcode.
 * @property Model\LabelType          $labelType                      Type d’étiquette.
 * @property Model\Address            $overrideShipperLabelAddress    Adresse expéditeur, visible uniquement sur l’étiquette.
 * @property bool                     $refnrasbarcode                 Active le code à barres client.
 * @property Model\ReferenceInBarcode $referenceInBarcode             Restitue les références 1, 2 et 3 sous forme de code à barres de type 128.
 */
class ReceiveLabelBcRequest extends AbstractInput implements RequestInterface
{
    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Model('customer', true, Model\Customer::class))
            ->addField(new Definition\AlphaNumeric('shipmentNumber', true, 28))
            ->addField(new Definition\Model('labelType', true, Model\LabelType::class))
            ->addField(new Definition\Model('overrideShipperLabelAddress', false, Model\Address::class))
            ->addField(new Definition\Boolean('refnrasbarcode', false))
            ->addField(new Definition\Model('referenceInBarcode', false, Model\ReferenceInBarcode::class));
    }
}

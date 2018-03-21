<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Request;

use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Model;
use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\RequestInterface;

/**
 * Class ReceiveLabelRequest
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property int                 $countrycode  Code pays (250 = France)
 * @property int                 $centernumber Code agence
 * @property int                 $parcelnumber N° de colis
 * @property bool                $refnrasbarcode
 * @property Model\LabelType     $labelType    Type d'étiquette
 * @property Model\Bic3LabelData $bic3data
 */
class ReceiveLabelRequest extends AbstractInput implements RequestInterface
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
            ->addField(new Definition\Boolean('refnrasbarcode', false))
            ->addField(new Definition\Model('labelType', false, Model\LabelType::class))
            ->addField(new Definition\Model('bic3data', false, Model\Bic3LabelData::class));
    }
}

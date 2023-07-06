<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\AbstractInput;
use Ekyna\Component\Dpd\Definition;
use Ekyna\Component\Dpd\EPrint\Api;
use Ekyna\Component\Dpd\EPrint\Enum\EType;
use Ekyna\Component\Dpd\Exception\RuntimeException;

/**
 * Class ShipmentBc
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property BcDataExt $Shipment Données d’expédition
 * @property string    $Type     Type d’expédition
 */
class ShipmentBc extends AbstractInput
{
    /**
     * Returns the tracking url.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    public function getTrackingUrl(): string
    {
        if (!isset($this->Shipment)) {
            throw new RuntimeException('Unknown shipment data');
        }

        return sprintf(Api::TRACKING_URL, $this->Shipment->BarcodeId);
    }

    /**
     * @inheritdoc
     */
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition
            ->addField(new Definition\Model('Shipment', false, BcDataExt::class))
            ->addField(new Definition\Enum('Type', false, EType::class));
    }
}

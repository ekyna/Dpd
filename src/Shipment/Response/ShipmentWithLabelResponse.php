<?php

namespace Ekyna\Component\Dpd\Shipment\Response;

use Ekyna\Component\Dpd\Shipment\Model\Label;
use Ekyna\Component\Dpd\Shipment\Model\Shipment;

/**
 * Class ShipmentWithLabelResponse
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentWithLabelResponse implements ResponseInterface
{
    /** @var Shipment[] */
    private $shipments = [];

    /** @var Label */
    private $label;


    /**
     * Constructor.
     *
     * @param Shipment[] $shipments
     * @param Label      $label
     */
    public function __construct($shipments, Label $label)
    {
        foreach ($shipments as $shipment) {
            $this->addShipment($shipment);
        }

        $this->label = $label;
    }

    /**
     * Adds the shipment.
     *
     * @param Shipment $shipment
     */
    private function addShipment(Shipment $shipment): void
    {
        $this->shipments[] = $shipment;
    }

    /**
     * Returns the shipments.
     *
     * @return Shipment[]
     */
    public function getShipments(): array
    {
        return $this->shipments;
    }

    /**
     * Returns the label.
     *
     * @return Label
     */
    public function getLabel(): Label
    {
        return $this->label;
    }
}

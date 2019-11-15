<?php

namespace Ekyna\Component\Dpd\Shipment\Request;

use Ekyna\Component\Dpd\Shipment\Model\Manifest;

/**
 * Class CreateShipmentWithLabelRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentWithLabelRequest extends ShipmentRequest
{
    /** @var Manifest */
    private $manifest;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->manifest = new Manifest();
    }

    /**
     * Returns the manifest.
     *
     * @return Manifest
     */
    public function getManifest(): ?Manifest
    {
        return $this->manifest;
    }

    /**
     * Sets the manifest.
     *
     * @param Manifest $manifest
     *
     * @return ShipmentRequest
     */
    public function setManifest(Manifest $manifest = null): ShipmentRequest
    {
        $this->manifest = $manifest;

        return $this;
    }
}

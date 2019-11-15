<?php

namespace Ekyna\Component\Dpd\Shipment\Response;

use Ekyna\Component\Dpd\Shipment\Model\Label;

/**
 * Class ReturnOnDemandResponse
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ReturnOnDemandResponse implements ResponseInterface
{
    /** @var int */
    private $shpId;

    /** @var int */
    private $manifestId;

    /** @var string[] */
    private $parcels;

    /** @var Label */
    private $label;


    /**
     * Constructor.
     *
     * @param string[] $parcels
     * @param Label    $label
     * @param int      $shpId
     * @param int      $manifestId
     */
    public function __construct(array $parcels, Label $label, int $shpId = null, int $manifestId = null)
    {
        $this->label = $label;
        $this->parcels = $parcels;
        $this->shpId = $shpId;
        $this->manifestId = $manifestId;
    }

    /**
     * Returns the shipment id.
     *
     * @return int
     */
    public function getShpId(): int
    {
        return $this->shpId;
    }

    /**
     * Returns the manifest id.
     *
     * @return int
     */
    public function getManifestId(): int
    {
        return $this->manifestId;
    }

    /**
     * Returns the parcels.
     *
     * @return string[]
     */
    public function getParcels(): array
    {
        return $this->parcels;
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

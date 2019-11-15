<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class Shipment
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Shipment
{
    /** @var string[] */
    private $parcels;

    /** @var int */
    private $shpId;

    /** @var int */
    private $returnShpId;

    /** @var int */
    private $manifestId;

    /** @var int */
    private $masterParcelId;

    /** @var string[] */
    private $returnParcels;


    /**
     * Constructor.
     *
     * @param string[] $parcels
     * @param int      $shpId
     * @param int      $returnShpId
     * @param int      $manifestId
     * @param int      $masterParcelId
     * @param string[] $returnParcels
     */
    public function __construct(
        array $parcels,
        int $shpId = null,
        int $returnShpId = null,
        int $manifestId = null,
        int $masterParcelId = null,
        array $returnParcels = null
    ) {
        $this->parcels = $parcels;
        $this->shpId = $shpId;
        $this->returnShpId = $returnShpId;
        $this->manifestId = $manifestId;
        $this->masterParcelId = $masterParcelId;
        $this->returnParcels = $returnParcels;
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
     * Returns the shpId.
     *
     * @return int
     */
    public function getShpId(): ?int
    {
        return $this->shpId;
    }

    /**
     * Returns the returnShpId.
     *
     * @return int
     */
    public function getReturnShpId(): ?int
    {
        return $this->returnShpId;
    }

    /**
     * Returns the manifestId.
     *
     * @return int
     */
    public function getManifestId(): ?int
    {
        return $this->manifestId;
    }

    /**
     * Returns the masterParcelId.
     *
     * @return int
     */
    public function getMasterParcelId(): ?int
    {
        return $this->masterParcelId;
    }

    /**
     * Returns the returnParcels.
     *
     * @return string[]
     */
    public function getReturnParcels(): ?array
    {
        return $this->returnParcels;
    }
}
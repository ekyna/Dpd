<?php

namespace Ekyna\Component\Dpd\Shipment\Response;

/**
 * Class CreateCollectionResponse
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreateCollectionResponse implements ResponseInterface
{
    /** @var int */
    private $coreInfoMessageId;

    /** @var int */
    private $colReqId;

    /** @var int */
    private $callId;

    /** @var int */
    private $ordernr;

    /** @var string */
    private $oid;

    /** @var \DateTime */
    private $createdAt;

    /** @var string */
    private $userCreate;

    /** @var string */
    private $odepot;

    /** @var string */
    private $rdepot;

    /** @var string */
    private $cdepot;

    /** @var string */
    private $parcelNo;

    /** @var int */
    private $masterCallId;

    /**
     * Constructor.
     *
     * @param int       $coreInfoMessageId
     * @param int       $colReqId
     * @param int       $callId
     * @param int       $ordernr
     * @param string    $oid
     * @param \DateTime $createdAt
     * @param string    $userCreate
     * @param string    $odepot
     * @param string    $rdepot
     * @param string    $cdepot
     * @param string    $parcelNo
     * @param int       $masterCallId
     */
    public function __construct(
        int $coreInfoMessageId,
        int $colReqId,
        int $callId,
        int $ordernr,
        string $oid,
        \DateTime $createdAt,
        string $userCreate,
        string $odepot,
        string $rdepot,
        string $cdepot,
        string $parcelNo,
        int $masterCallId = null
    ) {
        $this->coreInfoMessageId = $coreInfoMessageId;
        $this->colReqId = $colReqId;
        $this->callId = $callId;
        $this->ordernr = $ordernr;
        $this->oid = $oid;
        $this->createdAt = $createdAt;
        $this->userCreate = $userCreate;
        $this->odepot = $odepot;
        $this->rdepot = $rdepot;
        $this->cdepot = $cdepot;
        $this->parcelNo = $parcelNo;
        $this->masterCallId = $masterCallId;
    }

    /**
     * Returns the information message ID.
     *
     * @return int
     */
    public function getCoreInfoMessageId(): int
    {
        return $this->coreInfoMessageId;
    }

    /**
     * Returns the collection request id (Unused).
     *
     * @return int
     */
    public function getColReqId(): int
    {
        return $this->colReqId;
    }

    /**
     * Returns the collection request ID.
     *
     * @return int
     */
    public function getCallId(): int
    {
        return $this->callId;
    }

    /**
     * Returns the order number (Unused).
     *
     * @return int
     */
    public function getOrdernr(): int
    {
        return $this->ordernr;
    }

    /**
     * Returns the oid (Unused).
     *
     * @return string
     */
    public function getOid(): string
    {
        return $this->oid;
    }

    /**
     * Returns the creation date.
     *
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Returns the API credentials used.
     *
     * @return string
     */
    public function getUserCreate(): string
    {
        return $this->userCreate;
    }

    /**
     * Returns the DPD depot code of payer.
     *
     * @return string
     */
    public function getOdepot(): string
    {
        return $this->odepot;
    }

    /**
     * Returns the DPD depot code of consignee.
     *
     * @return string
     */
    public function getRdepot(): string
    {
        return $this->rdepot;
    }

    /**
     * Returns the DPD depot code of pickup place.
     *
     * @return string
     */
    public function getCdepot(): string
    {
        return $this->cdepot;
    }

    /**
     * Returns the parcel number.
     *
     * @return string
     */
    public function getParcelNo(): string
    {
        return $this->parcelNo;
    }

    /**
     * Returns the master call id, in case parcelCount > 1.
     *
     * @return int
     */
    public function getMasterCallId(): int
    {
        return $this->masterCallId;
    }
}

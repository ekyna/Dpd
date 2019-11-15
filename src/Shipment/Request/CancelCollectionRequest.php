<?php

namespace Ekyna\Component\Dpd\Shipment\Request;

/**
 * Class CancelCollectionRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CancelCollectionRequest implements RequestInterface
{
    /** @var int */
    private $callId;

    /** @var int */
    private $parcelNumber;


    /**
     * Returns the call id.
     *
     * @return int
     */
    public function getCallId(): ?int
    {
        return $this->callId;
    }

    /**
     * Sets the call id.
     *
     * @param int $id
     *
     * @return CancelCollectionRequest
     */
    public function setCallId(int $id = null): self
    {
        $this->callId = $id;

        return $this;
    }

    /**
     * Returns the parcel number.
     *
     * @return int
     */
    public function getParcelNumber(): ?int
    {
        return $this->parcelNumber;
    }

    /**
     * Sets the parcel number.
     *
     * @param int $number
     *
     * @return CancelCollectionRequest
     */
    public function setParcelNumber(int $number = null): self
    {
        $this->parcelNumber = $number;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValidationGroups(): array
    {
        return ['Default'];
    }
}

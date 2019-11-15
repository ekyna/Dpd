<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class Credentials
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Credentials
{
    /** @var int */
    private $payerId;

    /** @var int */
    private $payerAddressId;

    /** @var int */
    private $senderId;

    /** @var int */
    private $senderAddressId;

    /** @var string */
    private $departureUnitId;

    /** @var string */
    private $senderZipCode;

    /** @var string */
    private $senderCountryCode;


    /**
     * Returns the payer id.
     *
     * @return int
     */
    public function getPayerId(): ?int
    {
        return $this->payerId;
    }

    /**
     * Sets the payer id.
     *
     * @param int $payerId
     *
     * @return Credentials
     */
    public function setPayerId(int $payerId): self
    {
        $this->payerId = $payerId;

        return $this;
    }

    /**
     * Returns the payer address id.
     *
     * @return int
     */
    public function getPayerAddressId(): ?int
    {
        return $this->payerAddressId;
    }

    /**
     * Sets the payer address id.
     *
     * @param int $payerAddressId
     *
     * @return Credentials
     */
    public function setPayerAddressId(int $payerAddressId): self
    {
        $this->payerAddressId = $payerAddressId;

        return $this;
    }

    /**
     * Returns the sender id.
     *
     * @return int
     */
    public function getSenderId(): ?int
    {
        return $this->senderId;
    }

    /**
     * Sets the sender id.
     *
     * @param int $senderId
     *
     * @return Credentials
     */
    public function setSenderId(int $senderId): self
    {
        $this->senderId = $senderId;

        return $this;
    }

    /**
     * Returns the sender address id.
     *
     * @return int
     */
    public function getSenderAddressId(): ?int
    {
        return $this->senderAddressId;
    }

    /**
     * Sets the sender address id.
     *
     * @param int $senderAddressId
     *
     * @return Credentials
     */
    public function setSenderAddressId(int $senderAddressId): self
    {
        $this->senderAddressId = $senderAddressId;

        return $this;
    }

    /**
     * Returns the departure unit id.
     *
     * @return string
     */
    public function getDepartureUnitId(): ?string
    {
        return $this->departureUnitId;
    }

    /**
     * Sets the departure unit id.
     *
     * @param string $departureUnitId
     *
     * @return Credentials
     */
    public function setDepartureUnitId(string $departureUnitId): self
    {
        $this->departureUnitId = $departureUnitId;

        return $this;
    }

    /**
     * Returns the sender zip code.
     *
     * @return string
     */
    public function getSenderZipCode(): ?string
    {
        return $this->senderZipCode;
    }

    /**
     * Sets the sender zip code.
     *
     * @param string $senderZipCode
     *
     * @return Credentials
     */
    public function setSenderZipCode(string $senderZipCode): self
    {
        $this->senderZipCode = $senderZipCode;

        return $this;
    }

    /**
     * Returns the sender country code.
     *
     * @return string
     */
    public function getSenderCountryCode(): ?string
    {
        return $this->senderCountryCode;
    }

    /**
     * Sets the sender country code.
     *
     * @param string $senderCountryCode
     *
     * @return Credentials
     */
    public function setSenderCountryCode(string $senderCountryCode): self
    {
        $this->senderCountryCode = $senderCountryCode;

        return $this;
    }
}

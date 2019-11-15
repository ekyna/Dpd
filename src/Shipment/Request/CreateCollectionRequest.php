<?php

namespace Ekyna\Component\Dpd\Shipment\Request;

use Ekyna\Component\Dpd\Shipment\Model\Address;

/**
 * Class CreateCollectionRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreateCollectionRequest implements RequestInterface
{
    /** @var string */
    private $reqChannel = 'E';

    /** @var string */
    private $custref;

    /** @var float */
    private $weight;

    /** @var int */
    private $parcelCount = 1;

    /** @var \DateTime */
    private $desiredPickupDate;

    /** @var Address */
    private $pickupAddress;

    /** @var Address */
    private $deliveryAddress;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->pickupAddress = new Address();
        $this->deliveryAddress = new Address();
    }

    /**
     * Returns the req channel.
     *
     * @return string
     */
    public function getReqChannel(): string
    {
        return $this->reqChannel;
    }

    /**
     * Sets the req channel.
     *
     * @param string $channel
     *
     * @return CreateCollectionRequest
     */
    public function setReqChannel(string $channel): self
    {
        $this->reqChannel = $channel;

        return $this;
    }

    /**
     * Returns the customer ref.
     *
     * @return string
     */
    public function getCustref(): ?string
    {
        return $this->custref;
    }

    /**
     * Sets the customer ref.
     *
     * @param string $custref
     *
     * @return CreateCollectionRequest
     */
    public function setCustref(string $custref = null): self
    {
        $this->custref = $custref;

        return $this;
    }

    /**
     * Returns the weight.
     *
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * Sets the weight.
     *
     * @param float $weight
     *
     * @return CreateCollectionRequest
     */
    public function setWeight(float $weight = null): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Returns the parcel count.
     *
     * @return int
     */
    public function getParcelCount(): int
    {
        return $this->parcelCount;
    }

    /**
     * Sets the parcel count.
     *
     * @param int $count
     *
     * @return CreateCollectionRequest
     */
    public function setParcelCount(int $count): self
    {
        $this->parcelCount = $count;

        return $this;
    }

    /**
     * Returns the desired pickup date.
     *
     * @return \DateTime
     */
    public function getDesiredPickupDate(): ?\DateTime
    {
        return $this->desiredPickupDate;
    }

    /**
     * Sets the desired pickup date.
     *
     * @param \DateTime $date
     *
     * @return CreateCollectionRequest
     */
    public function setDesiredPickupDate(\DateTime $date): self
    {
        $this->desiredPickupDate = $date;

        return $this;
    }

    /**
     * Returns the pickup address.
     *
     * @return Address
     */
    public function getPickupAddress(): Address
    {
        return $this->pickupAddress;
    }

    /**
     * Sets the pickup address.
     *
     * @param Address $address
     *
     * @return CreateCollectionRequest
     */
    public function setPickupAddress(Address $address): self
    {
        $this->pickupAddress = $address;

        return $this;
    }

    /**
     * Returns the delivery address.
     *
     * @return Address
     */
    public function getDeliveryAddress(): Address
    {
        return $this->deliveryAddress;
    }

    /**
     * Sets the delivery address.
     *
     * @param Address $address
     *
     * @return CreateCollectionRequest
     */
    public function setDeliveryAddress(Address $address): self
    {
        $this->deliveryAddress = $address;

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

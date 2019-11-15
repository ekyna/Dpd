<?php

namespace Ekyna\Component\Dpd\Shipment\Request;

use Ekyna\Component\Dpd\Shipment\Model\Address;
use Ekyna\Component\Dpd\Shipment\Model\Parcel;
use Ekyna\Component\Dpd\Shipment\Model\Products;

/**
 * Class ShipmentRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentRequest extends AbstractCredentialRequest
{
    /** @var \DateTime */
    private $shipmentDate;

    /** @var Address */
    private $receiver;

    /** @var bool */
    private $replaceSender = false;

    /** @var Address */
    private $replaceSenderAddress;

    /** @var string */
    private $parcelShopId;

    /** @var int */
    private $returnType;

    /** @var bool */
    private $sameReturnAddress = true;

    /** @var Address */
    private $returnAddress;

    /** @var bool */
    private $mps = false;

    /** @var array|Parcel[] */
    private $parcels = [];

    /** @var string */
    private $product = Products::CLASSIC;


    /**
     * Returns the shipment date.
     *
     * @return \DateTime
     */
    public function getShipmentDate(): ?\DateTime
    {
        return $this->shipmentDate;
    }

    /**
     * Sets the shipment date.
     *
     * @param \DateTime $date
     *
     * @return ShipmentRequest
     */
    public function setShipmentDate(\DateTime $date = null): ShipmentRequest
    {
        $this->shipmentDate = $date;

        return $this;
    }

    /**
     * Returns the receiver.
     *
     * @return Address
     */
    public function getReceiver(): ?Address
    {
        return $this->receiver;
    }

    /**
     * Sets the receiver.
     *
     * @param Address $receiver
     *
     * @return ShipmentRequest
     */
    public function setReceiver(Address $receiver): ShipmentRequest
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Returns whether to replace the sender address.
     *
     * @return bool
     */
    public function isReplaceSender(): bool
    {
        return $this->replaceSender;
    }

    /**
     * Sets whether to replace the sender address.
     *
     * @param bool $replace
     *
     * @return ShipmentRequest
     */
    public function setReplaceSender(bool $replace): ShipmentRequest
    {
        $this->replaceSender = $replace;

        return $this;
    }

    /**
     * Returns the replacement sender address.
     *
     * @return Address
     */
    public function getReplaceSenderAddress(): ?Address
    {
        return $this->replaceSenderAddress;
    }

    /**
     * Sets the replacement sender address.
     *
     * @param Address $address
     *
     * @return ShipmentRequest
     */
    public function setReplaceSenderAddress(Address $address = null): ShipmentRequest
    {
        $this->replaceSenderAddress = $address;

        return $this;
    }

    /**
     * Returns the parcel shop id.
     *
     * @return string
     */
    public function getParcelShopId(): ?string
    {
        return $this->parcelShopId;
    }

    /**
     * Sets the parcel shop id.
     *
     * @param string $parcelShopId
     *
     * @return ShipmentRequest
     */
    public function setParcelShopId(string $parcelShopId = null): ShipmentRequest
    {
        $this->parcelShopId = $parcelShopId;

        return $this;
    }

    /**
     * Returns the return type.
     *
     * @return int
     */
    public function getReturnType(): ?int
    {
        return $this->returnType;
    }

    /**
     * Sets the return type.
     *
     * @param int $type
     *
     * @return ShipmentRequest
     */
    public function setReturnType(int $type = null): ShipmentRequest
    {
        $this->returnType = $type;

        return $this;
    }

    /**
     * Returns the same return address.
     *
     * @return bool
     */
    public function isSameReturnAddress(): bool
    {
        return $this->sameReturnAddress;
    }

    /**
     * Sets the sameReturnAddress.
     *
     * @param bool $same
     *
     * @return ShipmentRequest
     */
    public function setSameReturnAddress(bool $same): ShipmentRequest
    {
        $this->sameReturnAddress = $same;

        return $this;
    }

    /**
     * Returns the return address.
     *
     * @return Address
     */
    public function getReturnAddress(): ?Address
    {
        return $this->returnAddress;
    }

    /**
     * Sets the return address.
     *
     * @param Address $address
     *
     * @return ShipmentRequest
     */
    public function setReturnAddress(Address $address = null): ShipmentRequest
    {
        $this->returnAddress = $address;

        return $this;
    }

    /**
     * Returns the mps.
     *
     * @return bool
     */
    public function isMps(): bool
    {
        return $this->mps;
    }

    /**
     * Sets the mps.
     *
     * @param bool $mps
     *
     * @return ShipmentRequest
     */
    public function setMps(bool $mps): ShipmentRequest
    {
        $this->mps = $mps;

        return $this;
    }

    /**
     * Returns the parcels.
     *
     * @return array|Parcel[]
     */
    public function getParcels(): array
    {
        return $this->parcels;
    }

    /**
     * Adds the parcels.
     *
     * @param Parcel $parcel
     *
     * @return ShipmentRequest
     */
    public function addParcel(Parcel $parcel): ShipmentRequest
    {
        $this->parcels[] = $parcel;

        return $this;
    }

    /**
     * Returns the product id.
     *
     * @return string
     */
    public function getProduct(): string
    {
        return $this->product;
    }

    /**
     * Sets the product type.
     *
     * @param string $product
     *
     * @return ShipmentRequest
     */
    public function setProduct(string $product): ShipmentRequest
    {
        $this->product = $product;

        return $this;
    }

    public function getValidationGroups(): array
    {
        return ['Default', $this->getProduct()];
    }
}

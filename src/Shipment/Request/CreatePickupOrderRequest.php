<?php

namespace Ekyna\Component\Dpd\Shipment\Request;

/**
 * Class CreatePickupOrderRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CreatePickupOrderRequest extends AbstractCredentialRequest
{
    /** @var string */
    private $reqChannel = 'E';

    /** @var string  */
    private $callType = '01';

    /** @var string */
    private $contactPerson;

    /** @var \DateTime */
    private $fromDate;

    /** @var \DateTime */
    private $toDate;


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
     * @return CreatePickupOrderRequest
     */
    public function setReqChannel(string $channel): self
    {
        $this->reqChannel = $channel;

        return $this;
    }

    /**
     * Returns the call type.
     *
     * @return string
     */
    public function getCallType(): string
    {
        return $this->callType;
    }

    /**
     * Sets the call type.
     *
     * @param string $type
     *
     * @return CreatePickupOrderRequest
     */
    public function setCallType(string $type): self
    {
        $this->callType = $type;

        return $this;
    }

    /**
     * Returns the contact person.
     *
     * @return string
     */
    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    /**
     * Sets the contact person.
     *
     * @param string $person
     *
     * @return CreatePickupOrderRequest
     */
    public function setContactPerson(string $person): self
    {
        $this->contactPerson = $person;

        return $this;
    }

    /**
     * Returns the from date.
     *
     * @return \DateTime
     */
    public function getFromDate(): ?\DateTime
    {
        return $this->fromDate;
    }

    /**
     * Sets the from date.
     *
     * @param \DateTime $date
     *
     * @return CreatePickupOrderRequest
     */
    public function setFromDate(\DateTime $date): self
    {
        $this->fromDate = $date;

        return $this;
    }

    /**
     * Returns the to date.
     *
     * @return \DateTime
     */
    public function getToDate(): ?\DateTime
    {
        return $this->toDate;
    }

    /**
     * Sets the to date.
     *
     * @param \DateTime $date
     *
     * @return CreatePickupOrderRequest
     */
    public function setToDate(\DateTime $date): self
    {
        $this->toDate = $date;

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

<?php

namespace Ekyna\Component\Dpd\Relay\Request;

/**
 * Class ListRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ListRequest implements RequestInterface
{
    /**
     * @var string
     */
    private $address;

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var int
     */
    private $weight;

    /**
     * @var string
     */
    private $requestId;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var int
     */
    private $maxNumber;

    /**
     * @var int
     */
    private $maxDistance;

    /**
     * @var string
     */
    private $category;

    /**
     * @var boolean
     */
    private $holiday;


    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->date = new \DateTime('+1 day');
    }

    /**
     * Returns the address.
     *
     * @return string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Sets the address.
     *
     * @param string $address
     *
     * @return ListRequest
     */
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Returns the zip code.
     *
     * @return string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * Sets the zip code.
     *
     * @param string $zipCode
     *
     * @return ListRequest
     */
    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Returns the city.
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Sets the city.
     *
     * @param string $city
     *
     * @return ListRequest
     */
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Returns the country code.
     *
     * @return string
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * Sets the country code.
     *
     * @param string $countryCode
     *
     * @return ListRequest
     */
    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     * Returns the weight in kilograms.
     *
     * @return int
     */
    public function getWeight(): ?int
    {
        return $this->weight;
    }

    /**
     * Sets the weight in kilograms.
     *
     * @param int $weight
     *
     * @return ListRequest
     */
    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Returns the request id.
     *
     * @return string
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }

    /**
     * Sets the request id.
     *
     * @param string $requestId
     *
     * @return ListRequest
     */
    public function setRequestId(string $requestId): self
    {
        $this->requestId = $requestId;

        return $this;
    }

    /**
     * Returns the date from.
     *
     * @return \DateTime
     */
    public function getDate(): \DateTime
    {
        return $this->date;
    }

    /**
     * Sets the date from.
     *
     * @param \DateTime $date
     *
     * @return ListRequest
     */
    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Returns the max number of results.
     *
     * @return int
     */
    public function getMaxNumber(): ?int
    {
        return $this->maxNumber;
    }

    /**
     * Sets the max number of results.
     *
     * @param int $maxNumber
     *
     * @return ListRequest
     */
    public function setMaxNumber(int $maxNumber): self
    {
        $this->maxNumber = $maxNumber;

        return $this;
    }

    /**
     * Returns the max distance in kilometers.
     *
     * @return int
     */
    public function getMaxDistance(): ?int
    {
        return $this->maxDistance;
    }

    /**
     * Sets the max distance in kilometers.
     *
     * @param int $maxDistance
     *
     * @return ListRequest
     */
    public function setMaxDistance(int $maxDistance): self
    {
        $this->maxDistance = $maxDistance;

        return $this;
    }

    /**
     * Returns the category.
     *
     * @return string
     */
    public function getCategory(): ?string
    {
        return $this->category;
    }

    /**
     * Sets the category.
     *
     * @param string $category
     *
     * @return ListRequest
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Returns whether to returns holiday results.
     *
     * @return bool
     */
    public function isHoliday(): ?bool
    {
        return $this->holiday;
    }

    /**
     * Sets whether to returns holiday results.
     *
     * @param bool $holiday
     *
     * @return ListRequest
     */
    public function setHoliday(bool $holiday): self
    {
        $this->holiday = $holiday;

        return $this;
    }
}

<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class Address
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Address
{
    /** @var string */
    private $name;

    /** @var string */
    private $firstName;

    /** @var string */
    private $lastName;

    /** @var string */
    private $houseNumber;

    /** @var string */
    private $street;

    /** @var string */
    private $streetInfo;

    /** @var string */
    private $zipCode;

    /** @var string */
    private $city;

    /** @var string */
    private $countryCode;

    /** @var string */
    private $phoneNumber;

    /** @var string */
    private $mobileNumber;

    /** @var string */
    private $email;

    /** @var string */
    private $code1;

    /** @var string */
    private $code2;

    /** @var string */
    private $intercom;

    /** @var string */
    private $additionalInfo;


    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets the name.
     *
     * @param string $name
     *
     * @return Address
     */
    public function setName(string $name = null): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Returns the first name.
     *
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Sets the first name.
     *
     * @param string $name
     *
     * @return Address
     */
    public function setFirstName(string $name = null): self
    {
        $this->firstName = $name;

        return $this;
    }

    /**
     * Returns the last name.
     *
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Sets the last name.
     *
     * @param string $name
     *
     * @return Address
     */
    public function setLastName(string $name = null): self
    {
        $this->lastName = $name;

        return $this;
    }

    /**
     * Returns the house number.
     *
     * @return string
     */
    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    /**
     * Sets the house number.
     *
     * @param string $number
     *
     * @return Address
     */
    public function setHouseNumber(string $number = null): self
    {
        $this->houseNumber = $number;

        return $this;
    }

    /**
     * Returns the street.
     *
     * @return string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * Sets the street.
     *
     * @param string $street
     *
     * @return Address
     */
    public function setStreet(string $street = null): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Returns the street info.
     *
     * @return string
     */
    public function getStreetInfo(): ?string
    {
        return $this->streetInfo;
    }

    /**
     * Sets the street info.
     *
     * @param string $info
     *
     * @return Address
     */
    public function setStreetInfo(string $info = null): self
    {
        $this->streetInfo = $info;

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
     * @param string $code
     *
     * @return Address
     */
    public function setZipCode(string $code = null): self
    {
        $this->zipCode = $code;

        return $this;
    }

    /**
     * Returns the city.
     *
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Sets the city.
     *
     * @param string $name
     *
     * @return Address
     */
    public function setCity(string $name = null): self
    {
        $this->city = $name;

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
     * @param string $code
     *
     * @return Address
     */
    public function setCountryCode(string $code = null): self
    {
        $this->countryCode = $code;

        return $this;
    }

    /**
     * Returns the phone number.
     *
     * @return string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * Sets the phone number.
     *
     * @param string $number
     *
     * @return Address
     */
    public function setPhoneNumber(string $number = null): self
    {
        $this->phoneNumber = $number;

        return $this;
    }

    /**
     * Returns the mobile number.
     *
     * @return string
     */
    public function getMobileNumber(): ?string
    {
        return $this->mobileNumber;
    }

    /**
     * Sets the mobile number.
     *
     * @param string $string
     *
     * @return Address
     */
    public function setMobileNumber(string $string = null): self
    {
        $this->mobileNumber = $string;

        return $this;
    }

    /**
     * Returns the email.
     *
     * @return string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Sets the email.
     *
     * @param string $email
     *
     * @return Address
     */
    public function setEmail(string $email = null): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Returns the code1.
     *
     * @return string
     */
    public function getCode1(): ?string
    {
        return $this->code1;
    }

    /**
     * Sets the code1.
     *
     * @param string $code
     *
     * @return Address
     */
    public function setCode1(string $code = null): self
    {
        $this->code1 = $code;

        return $this;
    }

    /**
     * Returns the code2.
     *
     * @return string
     */
    public function getCode2(): ?string
    {
        return $this->code2;
    }

    /**
     * Sets the code2.
     *
     * @param string $code
     *
     * @return Address
     */
    public function setCode2(string $code = null): self
    {
        $this->code2 = $code;

        return $this;
    }

    /**
     * Returns the intercom.
     *
     * @return string
     */
    public function getIntercom(): ?string
    {
        return $this->intercom;
    }

    /**
     * Sets the intercom.
     *
     * @param string $intercom
     *
     * @return Address
     */
    public function setIntercom(string $intercom = null): self
    {
        $this->intercom = $intercom;

        return $this;
    }

    /**
     * Returns the additional information / delivery instruction.
     *
     * @return string
     */
    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    /**
     * Sets the additional information / delivery instruction.
     *
     * @param string $info
     *
     * @return Address
     */
    public function setAdditionalInfo(string $info = null): self
    {
        $this->additionalInfo = $info;

        return $this;
    }
}

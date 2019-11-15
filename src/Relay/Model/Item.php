<?php

namespace Ekyna\Component\Dpd\Relay\Model;

/**
 * Class Item
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Item
{
    /**
     * Identifiant du relais Pickup
     *
     * @var string
     */
    private $id;

    /**
     * Distance exprimée en mètres entre l'adresse du destinataire et le relais Pickup
     *
     * @var int
     */
    private $distance;

    /**
     * Nom de l'enseigne
     *
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $address1;

    /**
     * @var string
     */
    private $address2;

    /**
     * @var string
     */
    private $address3;

    /**
     * Indice de localisation. Ex : près de la mairie
     *
     * @var string
     */
    private $localHint;

    /**
     * @var string
     */
    private $zipCode;

    /**
     * @var string
     */
    private $city;

    /**
     * @var float
     */
    private $longitude;

    /**
     * @var float
     */
    private $latitude;

    /**
     * @var string
     */
    private $mapUrl;

    /**
     * Disponibilité du point :
     * full = pas de congé sur la période de recherche
     * partial = congés <= seuil toléré dans la période de recherche
     *
     * @var string
     */
    private $available;

    /**
     * @var OpeningHour[]
     */
    private $openingHours;

    /**
     * @var Holiday[]
     */
    private $holidays;


    /**
     * Constructor.
     *
     * @param string $id
     * @param int    $distance
     * @param string $name
     * @param string $address1
     * @param string $address2
     * @param string $address3
     * @param string $localHint
     * @param string $zipCode
     * @param string $city
     * @param float  $longitude
     * @param float  $latitude
     * @param string $mapUrl
     * @param string $available
     */
    public function __construct(
        string $id,
        int $distance,
        string $name,
        string $address1,
        string $address2,
        string $address3,
        string $localHint,
        string $zipCode,
        string $city,
        float $longitude,
        float $latitude,
        string $mapUrl,
        string $available
    ) {
        $this->id = $id;
        $this->distance = $distance;
        $this->name = $name;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->address3 = $address3;
        $this->localHint = $localHint;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->mapUrl = $mapUrl;
        $this->available = $available;

        $this->openingHours = [];
        $this->holidays = [];
    }

    /**
     * Returns the id.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Returns the distance.
     *
     * @return int
     */
    public function getDistance(): int
    {
        return $this->distance;
    }

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the address1.
     *
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * Returns the address2.
     *
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * Returns the address3.
     *
     * @return string
     */
    public function getAddress3(): string
    {
        return $this->address3;
    }

    /**
     * Returns the localHint.
     *
     * @return string
     */
    public function getLocalHint(): string
    {
        return $this->localHint;
    }

    /**
     * Returns the zipCode.
     *
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
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
     * Returns the longitude.
     *
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * Returns the latitude.
     *
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * Returns the mapUrl.
     *
     * @return string
     */
    public function getMapUrl(): string
    {
        return $this->mapUrl;
    }

    /**
     * Returns the available.
     *
     * @return string
     */
    public function getAvailable(): string
    {
        return $this->available;
    }

    /**
     * Returns the openingHours.
     *
     * @return OpeningHour[]
     */
    public function getOpeningHours(): array
    {
        return $this->openingHours;
    }

    /**
     * Adds the opening hour.
     *
     * @param OpeningHour $openingHour
     *
     * @return Item
     */
    public function addOpeningHour(OpeningHour $openingHour): Item
    {
        $this->openingHours[] = $openingHour;

        return $this;
    }

    /**
     * Returns the holidays.
     *
     * @return Holiday[]
     */
    public function getHolidays(): array
    {
        return $this->holidays;
    }

    /**
     * Adds the opening hour.
     *
     * @param Holiday $holiday
     *
     * @return Item
     */
    public function addHoliday(Holiday $holiday): Item
    {
        $this->holidays[] = $holiday;

        return $this;
    }
}
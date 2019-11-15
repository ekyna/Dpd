<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class Parcel
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Parcel
{
    /** @var string */
    private $cref1;

    /** @var string */
    private $cref2;

    /** @var string */
    private $cref3;

    /** @var string */
    private $cref4;

    /** @var float */
    private $hinsAmount;

    /** @var float */
    private $weight = 0;


    /**
     * Returns the reference 1.
     *
     * @return string
     */
    public function getCref1(): ?string
    {
        return $this->cref1;
    }

    /**
     * Sets the reference 1.
     *
     * @param string $reference
     *
     * @return Parcel
     */
    public function setCref1(string $reference): self
    {
        $this->cref1 = $reference;

        return $this;
    }

    /**
     * Returns the reference 2.
     *
     * @return string
     */
    public function getCref2(): ?string
    {
        return $this->cref2;
    }

    /**
     * Sets the reference 2.
     *
     * @param string $cref2
     *
     * @return Parcel
     */
    public function setCref2(string $cref2 = null): self
    {
        $this->cref2 = $cref2;

        return $this;
    }

    /**
     * Returns the reference 3.
     *
     * @return string
     */
    public function getCref3(): ?string
    {
        return $this->cref3;
    }

    /**
     * Sets the reference 3.
     *
     * @param string $reference
     *
     * @return Parcel
     */
    public function setCref3(string $reference = null): self
    {
        $this->cref3 = $reference;

        return $this;
    }

    /**
     * Returns the reference 4.
     *
     * @return string
     */
    public function getCref4(): ?string
    {
        return $this->cref4;
    }

    /**
     * Sets the reference 4.
     *
     * @param string $cref4
     *
     * @return Parcel
     */
    public function setCref4(string $cref4 = null): self
    {
        $this->cref4 = $cref4;

        return $this;
    }

    /**
     * Returns the hins amount.
     *
     * @return float
     */
    public function getHinsAmount(): ?float
    {
        return $this->hinsAmount;
    }

    /**
     * Sets the hins amount.
     *
     * @param float $amount
     *
     * @return Parcel
     */
    public function setHinsAmount(float $amount): self
    {
        $this->hinsAmount = $amount;

        return $this;
    }

    /**
     * Returns the weight.
     *
     * @return float
     */
    public function getWeight(): ?float
    {
        return $this->weight;
    }

    /**
     * Sets the weight.
     *
     * @param float $weight
     *
     * @return Parcel
     */
    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }
}

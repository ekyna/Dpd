<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class Manifest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Manifest
{
    /** @var string */
    private $language = 'fr';

    /** @var string */
    private $labelFormat = Formats::A6;

    /** @var boolean */
    private $referenceAsBarcode = false;

    /** @var string */
    private $fileType = FileTypes::PDF;

    /** @var int */
    private $dpi = Dpi::DPI_203;


    /**
     * Returns the language.
     *
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * Sets the language.
     *
     * @param string $language
     *
     * @return Manifest
     */
    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Returns the label format.
     *
     * @return string
     */
    public function getLabelFormat(): string
    {
        return $this->labelFormat;
    }

    /**
     * Sets the label format.
     *
     * @param string $format
     *
     * @return Manifest
     */
    public function setLabelFormat(string $format): self
    {
        $this->labelFormat = $format;

        return $this;
    }

    /**
     * Returns the reference as barcode.
     *
     * @return bool
     */
    public function isReferenceAsBarcode(): bool
    {
        return $this->referenceAsBarcode;
    }

    /**
     * Sets the reference as barcode.
     *
     * @param bool $asBarcode
     *
     * @return Manifest
     */
    public function setReferenceAsBarcode(bool $asBarcode): self
    {
        $this->referenceAsBarcode = $asBarcode;

        return $this;
    }

    /**
     * Returns the file type.
     *
     * @return string
     */
    public function getFileType(): string
    {
        return $this->fileType;
    }

    /**
     * Sets the file type.
     *
     * @param string $type
     *
     * @return Manifest
     */
    public function setFileType(string $type): self
    {
        $this->fileType = $type;

        return $this;
    }

    /**
     * Returns the dpi.
     *
     * @return int
     */
    public function getDpi(): int
    {
        return $this->dpi;
    }

    /**
     * Sets the dpi.
     *
     * @param int $dpi
     *
     * @return Manifest
     */
    public function setDpi(int $dpi): self
    {
        $this->dpi = $dpi;

        return $this;
    }
}

<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

use Ekyna\Component\Dpd\Exception\InvalidArgumentException;

/**
 * Class Products
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
final class Products
{
    /**
     * DPD CLASSIC
     * France, Europe
     * Deferred delivery in France and Europe
     */
    public const CLASSIC = 'classic';

    /**
     * DPD CLASSIC INTERCONTINENTAL
     * World excl. France, Europe
     * Delivery by air for destinations outside Europe
     */
    public const INTERNATIONAL = 'international';

    /**
     * PREDICT
     * France, Europe
     * Private customers delivery with an SMS/Mail interaction
     */
    public const PREDICT = 'predict';

    /**
     * DPD RELAIS
     * France
     * Delivery to a Pickup PUDO shop
     */
    public const RELAY  = 'relay';

    /**
     * DPD RETOUR
     * France
     * Parcel drop-off at a Pickup PUDO shop to be returned to sender
     */
    public const RETURN = 'return';

    /**
     * Returns the available constants.
     *
     * @return array
     */
    public static function getConstants(): array
    {
        return [
            self::CLASSIC,
            self::INTERNATIONAL,
            self::PREDICT,
            self::RELAY,
            self::RETURN,
        ];
    }

    /**
     * Returns the product code for the given constant.
     *
     * @param string $constant
     *
     * @return int
     */
    public static function getCode(string $constant): int
    {
        switch ($constant) {
            case self::CLASSIC:
                return 1;
            case self::INTERNATIONAL:
                return 40033;
            case self::PREDICT:
                return 40275;
            case self::RELAY:
                return 40276;
            case self::RETURN:
                return 40278;
        }

        throw new InvalidArgumentException("Unexpected product constant");
    }

    /** Disabled constructor */
    private function __construct()
    {
    }
}

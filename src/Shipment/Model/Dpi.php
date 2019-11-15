<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class Dpi
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
final class Dpi
{
    const DPI_203 = 203;
    const DPI_300 = 300;
    const DPI_600 = 600;


    /**
     * Returns the available constants.
     *
     * @return array
     */
    public static function getConstants(): array
    {
        return [
            self::DPI_203,
            self::DPI_300,
            self::DPI_600,
        ];
    }

    /** Disabled constructor */
    private function __construct() {}
}

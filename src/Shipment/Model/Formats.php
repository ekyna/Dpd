<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class Formats
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
final class Formats
{
    const A4 = 'A4';
    const A6 = 'A6';

    /**
     * Returns the available constants.
     *
     * @return array
     */
    public static function getConstants(): array
    {
        return [
            self::A4,
            self::A6,
        ];
    }

    /** Disabled constructor */
    private function __construct() {}
}

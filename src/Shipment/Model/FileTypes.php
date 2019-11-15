<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class FileTypes
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
final class FileTypes
{
    const PDF = 'PDF';
    const ZPL = 'ZPL';
    const EPL = 'EPL';


    /**
     * Returns the available constants.
     *
     * @return array
     */
    public static function getConstants(): array
    {
        return [
            self::PDF,
            self::ZPL,
            self::EPL,
        ];
    }

    /** Disabled constructor */
    private function __construct() {}
}

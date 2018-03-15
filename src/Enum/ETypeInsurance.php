<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Enum;

/**
 * Class ETypeInsurance
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class ETypeInsurance implements EnumInterface
{
    const BY_SHIPMENTS = 'byShipments'; // Au colis


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            static::BY_SHIPMENTS,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}
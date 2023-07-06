<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Enum;

/**
 * Class ETypeInsurance
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class ETypeInsurance implements EnumInterface
{
    public const BY_SHIPMENTS = 'byShipments'; // Au colis
    public const BY_WEIGHT    = 'byWeight';    // Au poids


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            ETypeInsurance::BY_SHIPMENTS,
            ETypeInsurance::BY_WEIGHT,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}

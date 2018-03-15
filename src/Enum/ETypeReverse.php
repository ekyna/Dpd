<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Enum;

/**
 * Class ETypeReverse
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class ETypeReverse implements EnumInterface
{
    const ON_DEMAND = 'OnDemand'; // Retour en Relais - Demandé
    const PREPARED = 'Prepared';  // Retour en Relais - Préparé


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            static::ON_DEMAND,
            static::PREPARED,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}
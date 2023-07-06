<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Enum;

/**
 * Class ETypeReverse
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class ETypeReverse implements EnumInterface
{
    public const ON_DEMAND = 'OnDemand';  // Retour en Relais - Demandé
    public const PREPARED  = 'Prepared';  // Retour en Relais - Préparé


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            ETypeReverse::ON_DEMAND,
            ETypeReverse::PREPARED,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}

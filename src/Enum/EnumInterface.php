<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Enum;

/**
 * Interface EnumInterface
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
interface EnumInterface
{
    /**
     * Returns the values.
     *
     * @return array
     */
    public static function getValues(): array;
}
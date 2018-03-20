<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Enum;

/**
 * Class ELabelType
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class ELabelType implements EnumInterface
{
    const PNG    = 'Default'; // Format PNG (valeur par défaut)
    const PDF    = 'PDF';     // Format PDF
    const PDF_A6 = 'PDF_A6';  // Format PDF – A6


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            static::PNG,
            static::PDF,
            static::PDF_A6,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}

<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Enum;

/**
 * Class ELabelType
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class ELabelType implements EnumInterface
{
    public const PNG       = 'Default'; // Format PNG (valeur par défaut)
    public const PDF       = 'PDF';     // Format PDF
    public const PDF_A6    = 'PDF_A6';  // Format PDF – A6
    public const ZPL       = 'ZPL';     // Format ZPL (Zebra Programming Language)
    public const ZPL300    = 'ZPL300';
    public const ZPL_A6    = 'ZPL_A6';
    public const ZPL300_A6 = 'ZPL300_A6';
    public const EPL       = 'EPL';


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            ELabelType::PNG,
            ELabelType::PDF,
            ELabelType::PDF_A6,
            ELabelType::ZPL,
            ELabelType::ZPL300,
            ELabelType::ZPL_A6,
            ELabelType::ZPL300_A6,
            ELabelType::EPL,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}

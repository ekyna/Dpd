<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Enum;

/**
 * Class EReferenceType
 * @package Ekyna\Component\Dpd\EPrint\Enum
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class EReferenceType implements EnumInterface
{
    const REFERENCE_NUMBER = 'Referencenumber';
    const REFERENCE_2      = 'Reference2';
    const REFERENCE_3      = 'Reference3';
    const REFERENCE_4      = 'Reference4';


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            static::REFERENCE_NUMBER,
            static::REFERENCE_2,
            static::REFERENCE_3,
            static::REFERENCE_4,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}

<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Enum;

/**
 * Class EBic3Mode
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class EBic3Mode implements EnumInterface
{
    const ONLY_STD_LABELS = 'OnlyStdLabels';
    const ONLY_BIC_3      = 'OnlyBic3';
    const ALL             = 'All';


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            static::ONLY_STD_LABELS,
            static::ONLY_BIC_3,
            static::ALL,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}

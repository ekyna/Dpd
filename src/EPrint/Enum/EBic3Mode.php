<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Enum;

/**
 * Class EBic3Mode
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class EBic3Mode implements EnumInterface
{
    public const ONLY_STD_LABELS = 'OnlyStdLabels';
    public const ONLY_BIC_3      = 'OnlyBic3';
    public const ALL             = 'All';


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            EBic3Mode::ONLY_STD_LABELS,
            EBic3Mode::ONLY_BIC_3,
            EBic3Mode::ALL,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}

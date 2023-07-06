<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Enum;

/**
 * Class ETypeConsolidation
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class ETypeConsolidation implements EnumInterface
{
    public const COMBINED_DELIVERY               = 'CombinedDelivery';              // Consolidation Livraison
    public const COMBINED_INVOICING              = 'CombinedInvoicing';             // Consolidation Facturation
    public const COMBINED_DELIVERY_AND_INVOICING = 'CombinedDeliveryAndInvoicing '; // Consolidation Livraison + Facturation


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            ETypeConsolidation::COMBINED_DELIVERY,
            ETypeConsolidation::COMBINED_INVOICING,
            ETypeConsolidation::COMBINED_DELIVERY_AND_INVOICING,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}

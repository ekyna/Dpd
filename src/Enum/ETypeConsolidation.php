<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Enum;

/**
 * Class ETypeConsolidation
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
final class ETypeConsolidation implements EnumInterface
{
    const COMBINED_DELIVERY               = 'CombinedDelivery';              // Consolidation Livraison
    const COMBINED_INVOICING              = 'CombinedInvoicing';             // Consolidation Facturation
    const COMBINED_DELIVERY_AND_INVOICING = 'CombinedDeliveryAndInvoicing '; // Consolidation Livraison + Facturation


    /**
     * @inheritdoc
     */
    public static function getValues(): array
    {
        return [
            static::COMBINED_DELIVERY,
            static::COMBINED_INVOICING,
            static::COMBINED_DELIVERY_AND_INVOICING,
        ];
    }

    /**
     * Disabled Constructor.
     */
    private function __construct()
    {
    }
}

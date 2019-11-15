<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class ReturnTypes
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
final class ReturnTypes
{
    /**
     * Prepared
     * Initial and return labels are both printed at the same time, you will include
     * the return label inside the parcel for a future usage by the consignee.
     */
    public const PREPARED  = 0;

    /**
     * On demand
     * Return label will be authorized and printed afterwards, by calling the
     * shipment/print/return-ondemand method, or by your consignee on our website dpd.fr.
     */
    public const ON_DEMAND = 1;


    /**
     * Returns the available constants.
     *
     * @return array
     */
    public static function getConstants(): array
    {
        return [
            self::PREPARED,
            self::ON_DEMAND,
        ];
    }

    /** Disabled constructor */
    private function __construct()
    {
    }
}

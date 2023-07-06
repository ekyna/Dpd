<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

/**
 * Class ShipmentDataExtended
 * @package Ekyna\Component\Dpd\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $Barcode
 * @property string $BarcodeSource
 * @property string $BarcodeId
 * @property int    $Sin
 */
class ShipmentDataExtendedBc extends ShipmentDataExtendedBase
{
    /**
     * @var ArrayOfServiceEntry
     */
    public $Services;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->Services) {
            $this->Services->initialize();
        }
    }
}

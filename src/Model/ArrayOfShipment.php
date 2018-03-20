<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

/**
 * Class ArrayOfShipment
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ArrayOfShipment extends \ArrayObject implements OutputInterface
{
    /**
     * @var Shipment|Shipment[]
     */
    public $Shipment;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->Shipment) {
            $data = is_array($this->Shipment) ? array_values($this->Shipment) : [$this->Shipment];
            $this->__construct($data);
            unset($this->Shipment);
        }
    }
}

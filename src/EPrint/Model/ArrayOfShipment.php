<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use ArrayObject;
use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class ArrayOfShipment
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @implements ArrayObject<int, Shipment>
 */
class ArrayOfShipment extends ArrayObject implements OutputInterface
{
    /**
     * @var Shipment|array<Shipment>|null
     */
    private Shipment|array|null $Shipment;


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

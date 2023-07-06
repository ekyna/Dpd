<?php

/** @noinspection PhpPropertyNamingConventionInspection */
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use ArrayObject;
use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class c
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @implements ArrayObject<int, ShipmentBc>
 */
class ArrayOfShipmentBc extends ArrayObject implements OutputInterface
{
    /**
     * @var ShipmentBc|array<ShipmentBc>|null
     */
    private ShipmentBc|array|null $ShipmentBc = null;

    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->ShipmentBc) {
            $data = is_array($this->ShipmentBc) ? array_values($this->ShipmentBc) : [$this->ShipmentBc];
            $this->__construct($data);
            unset($this->ShipmentBc);
        }
    }
}

<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use ArrayObject;
use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class ArrayOfShipping
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @implements ArrayObject<int, Shipping>
 */
class ArrayOfShipping extends ArrayObject implements OutputInterface
{
    /**
     * @var Shipping|array<Shipping>|null
     */
    public Shipping|array|null $Shipping;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->Shipping) {
            $data = is_array($this->Shipping) ? array_values($this->Shipping) : [$this->Shipping];
            $this->__construct($data);
            unset($this->Shipping);
        }
    }
}

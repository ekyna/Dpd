<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class ArrayOfShipping
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ArrayOfShipping extends \ArrayObject implements OutputInterface
{
    /**
     * @var Shipping|Shipping[]
     */
    public $Shipping;


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

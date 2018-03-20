<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

/**
 * Class ArrayOfLabel
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ArrayOfLabel extends \ArrayObject implements OutputInterface
{
    /**
     * @var Label|Label[]
     */
    public $Label;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->Label) {
            $data = is_array($this->Label) ? array_values($this->Label) : [$this->Label];
            $this->__construct($data);
            unset($this->Label);
        }
    }
}

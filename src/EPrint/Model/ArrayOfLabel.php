<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use ArrayObject;
use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class ArrayOfLabel
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @implements ArrayObject<int, Label>
 */
class ArrayOfLabel extends \ArrayObject implements OutputInterface
{
    /**
     * @var Label|array<Label>|null
     */
    private Label|array|null $Label;

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

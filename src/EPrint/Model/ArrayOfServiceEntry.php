<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use ArrayObject;
use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class ArrayOfServiceEntry
 * @package Ekyna\Component\Dpd\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @implements ArrayObject<int, ServiceEntry>
 */
class ArrayOfServiceEntry extends ArrayObject implements OutputInterface
{
    /**
     * @var ServiceEntry|array<ServiceEntry>|null
     */
    private ServiceEntry|array|null $ServiceEntry;

    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->ServiceEntry) {
            $data = is_array($this->ServiceEntry) ? array_values($this->ServiceEntry) : [$this->ServiceEntry];
            $this->__construct($data);
            unset($this->ServiceEntry);
        }
    }
}

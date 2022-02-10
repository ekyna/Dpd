<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Model;

use Ekyna\Component\Dpd\OutputInterface;

/**
 * Class GetShippingResult
 * @package Ekyna\Component\Dpd\EPrint\Model
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class GetShippingResult implements OutputInterface
{
    /**
     * @var ArrayOfShipping
     */
    public $shippings;


    /**
     * @inheritdoc
     */
    public function initialize(): void
    {
        if ($this->shippings) {
            $this->shippings->initialize();
        }
    }
}

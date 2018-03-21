<?php

namespace Ekyna\Component\Dpd\Pudo\Response;

use Ekyna\Component\Dpd\Pudo\Model\Item;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class GetPudoDetailsResponse
 * @package Ekyna\Component\Dpd\Pudo\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetPudoDetailsResponse implements ResponseInterface
{
    /**
     * @var Item
     */
    private $item;


    /**
     * Constructor.
     *
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Returns the item.
     *
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }
}

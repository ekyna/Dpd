<?php

namespace Ekyna\Component\Dpd\Relay\Response;

use Ekyna\Component\Dpd\Relay\Model\Item;

/**
 * Class DetailResponse
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class DetailResponse implements ResponseInterface
{
    /**
     * @var Item
     */
    private $item;


    /**
     * Returns the item.
     *
     * @return Item
     */
    public function getItem(): Item
    {
        return $this->item;
    }

    /**
     * Sets the item.
     *
     * @param Item $item
     *
     * @return DetailResponse
     */
    public function setItem(Item $item): self
    {
        $this->item = $item;

        return $this;
    }
}

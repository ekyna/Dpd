<?php

namespace Ekyna\Component\Dpd\Pudo\Response;

use Ekyna\Component\Dpd\Pudo\Model\Item;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class GetPudoListResponse
 * @package Ekyna\Component\Dpd\Pudo\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class GetPudoListResponse implements ResponseInterface
{
    /**
     * @var int
     */
    private $quality;

    /**
     * @var string
     */
    private $requestId;

    /**
     * @var Item[]
     */
    private $items;


    /**
     * Constructor.
     *
     * @param int    $quality
     * @param string $requestId
     */
    public function __construct(int $quality, string $requestId)
    {
        $this->quality = $quality;
        $this->requestId = $requestId;

        $this->items = [];
    }

    /**
     * Returns the quality.
     *
     * @return int
     */
    public function getQuality(): int
    {
        return $this->quality;
    }

    /**
     * Returns the requestId.
     *
     * @return string
     */
    public function getRequestId(): string
    {
        return $this->requestId;
    }

    /**
     * Returns the items.
     *
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Adds the item.
     *
     * @param Item $item
     *
     * @return GetPudoListResponse
     */
    public function addItem(Item $item): GetPudoListResponse
    {
        $this->items[] = $item;

        return $this;
    }
}

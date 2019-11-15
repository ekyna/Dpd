<?php

namespace Ekyna\Component\Dpd\Shipment\Request;

/**
 * Class CancelPickupOrderRequest
 * @package Ekyna\Component\Dpd\Shipment\Request
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class CancelPickupOrderRequest implements RequestInterface
{
    /** @var int */
    private $callId;


    /**
     * Returns the call id.
     *
     * @return int
     */
    public function getCallId(): int
    {
        return $this->callId;
    }

    /**
     * Sets the call id.
     *
     * @param int $id
     *
     * @return CancelPickupOrderRequest
     */
    public function setCallId(int $id): self
    {
        $this->callId = $id;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getValidationGroups(): array
    {
        return ['Default'];
    }
}

<?php

namespace Ekyna\Component\Dpd\Shipment\Response;

/**
 * Class PickupOrderResponse
 * @package Ekyna\Component\Dpd\Shipment\Response
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class PickupOrderResponse implements ResponseInterface
{
    /** @var int */
    private $callId;

    /** @var string */
    private $responseMessage;

    /** @var int */
    private $coreInfoMessage;


    /**
     * Constructor.
     *
     * @param int    $callId
     * @param string $responseMessage
     * @param int    $coreInfoMessage
     */
    public function __construct(int $callId, string $responseMessage = null, int $coreInfoMessage = null)
    {
        $this->callId = $callId;
        $this->responseMessage = $responseMessage;
        $this->coreInfoMessage = $coreInfoMessage;
    }

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
     * Returns the response message.
     *
     * @return string
     */
    public function getResponseMessage(): ?string
    {
        return $this->responseMessage;
    }

    /**
     * Returns the core info message.
     *
     * @return string
     */
    public function getCoreInfoMessage(): ?string
    {
        return $this->coreInfoMessage;
    }
}

<?php

namespace Ekyna\Component\Dpd\Shipment\Response;

/**
 * Class CancelCollectionResponse
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class CancelCollectionResponse implements ResponseInterface
{
    /** @var string */
    private $reqStatus;

    /** @var string */
    private $transferStatus;


    /**
     * Constructor.
     *
     * @param string $reqStatus
     * @param string $transferStatus
     */
    public function __construct(string $reqStatus, string $transferStatus = null)
    {
        $this->reqStatus = $reqStatus;
        $this->transferStatus = $transferStatus;
    }

    /**
     * Returns the req status.
     *
     * @return string
     */
    public function getReqStatus(): string
    {
        return $this->reqStatus;
    }

    /**
     * Returns the transfer status.
     *
     * @return string
     */
    public function getTransferStatus(): ?string
    {
        return $this->transferStatus;
    }
}

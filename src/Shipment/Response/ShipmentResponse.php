<?php

namespace Ekyna\Component\Dpd\Shipment\Response;

/**
 * Class ShipmentResponse
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class ShipmentResponse implements ResponseInterface
{
    /** @var string[] */
    private $tempShpId;


    /**
     * Constructor.
     *
     * @param string[] $tempShpId
     */
    public function __construct(array $tempShpId)
    {
        $this->tempShpId = [];

        foreach ($tempShpId as $id) {
            $this->tempShpId[] = (string) $id;
        }
    }

    /**
     * Returns the tempShpId.
     *
     * @return string[]
     */
    public function getTempShpId(): array
    {
        return $this->tempShpId;
    }
}

<?php

namespace Ekyna\Component\Dpd\Shipment\Request;

use Ekyna\Component\Dpd\Shipment\Model\Manifest;

/**
 * Class GetLabelRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class GetLabelRequest extends Manifest implements RequestInterface
{
    /** @var int */
    private $labelStartPosition = 1;

    /** @var array */
    private $shpIdList;


    /**
     * Returns the label start position.
     *
     * @return int
     */
    public function getLabelStartPosition(): int
    {
        return $this->labelStartPosition;
    }

    /**
     * Sets the label start position.
     *
     * @param int $position
     *
     * @return GetLabelRequest
     */
    public function setLabelStartPosition(int $position): GetLabelRequest
    {
        $this->labelStartPosition = $position;

        return $this;
    }

    /**
     * Returns the ship id list.
     *
     * @return string[]
     */
    public function getShpIdList(): array
    {
        return $this->shpIdList;
    }

    /**
     * Sets the ship id list.
     *
     * @param string[] $shpIdList
     *
     * @return GetLabelRequest
     */
    public function setShpIdList(array $shpIdList): GetLabelRequest
    {
        $this->shpIdList = [];

        foreach ($shpIdList as $id) {
            $this->addShpId((string)$id);
        }

        return $this;
    }

    /**
     * Adds the shipment id.
     *
     * @param string $id
     */
    private function addShpId(string $id): void
    {
        $this->shpIdList[] = $id;
    }

    /**
     * @inheritDoc
     */
    public function getValidationGroups(): array
    {
        return ['Default'];
    }
}

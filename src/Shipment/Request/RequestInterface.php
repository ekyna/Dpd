<?php

namespace Ekyna\Component\Dpd\Shipment\Request;

/**
 * Interface RequestInterface
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
interface RequestInterface
{
    /**
     * Returns the validation groups.
     *
     * @return string[]
     */
    public function getValidationGroups(): array;
}

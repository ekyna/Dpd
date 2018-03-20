<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

/**
 * Interface InputInterface
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
interface InputInterface
{
    /**
     * Validates the data.
     *
     * @param string $prefix The fields name's prefix
     *
     * @throws \Ekyna\Component\Dpd\Exception\ValidationException
     */
    public function validate(string $prefix = null): void;

    /**
     * Returns the data as array.
     *
     * @return array
     */
    public function toArray(): array;
}
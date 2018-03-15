<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Definition;

/**
 * Interface FieldInterface
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
interface FieldInterface
{
    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Validates the given value.
     *
     * @param mixed  $value
     * @param string $prefix
     *
     * @throws \Ekyna\Component\DpdWs\Exception\ValidationException
     */
    public function validate($value, string $prefix = null): void;
}
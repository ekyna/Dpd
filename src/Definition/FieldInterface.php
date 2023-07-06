<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\Definition;

use Ekyna\Component\Dpd\Exception\ValidationException;

/**
 * Interface FieldInterface
 * @package Ekyna\Component\Dpd
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
     * @param mixed       $value
     * @param string|null $prefix
     *
     * @throws ValidationException
     */
    public function validate(mixed $value, string $prefix = null): void;
}

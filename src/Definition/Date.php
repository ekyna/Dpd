<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\Definition;

/**
 * Class Date
 * @package Ekyna\Component\Dpd\Definition
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Date extends AbstractField
{
    /**
     * @inheritdoc
     */
    public function validate($value, string $prefix = null): void
    {
        if (empty($value)) {
            if ($this->required) {
                $this->throwValidationException('Value is required', $prefix);
            }

            return;
        }

        if (!is_string($value)) {
            $this->throwValidationException('Expected string value', $prefix);
        }

        if (!preg_match('~^[0-9]{2}[\./][0-9]{2}[\./][0-9]{4}$~', $value)) {
            $this->throwValidationException("Expected date string with format 'd.m.Y'", $prefix);
        }
    }
}

<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Definition;

/**
 * Class Boolean
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Boolean extends AbstractField
{
    /**
     * @inheritdoc
     */
    public function validate($value, string $prefix = null): void
    {
        if (null === $value) {
            if ($this->required) {
                $this->throwValidationException("Value is required", $prefix);
            }

            return;
        }

        if (!is_bool($value)) {
            $this->throwValidationException("Unexpected boolean value", $prefix);
        }
    }
}

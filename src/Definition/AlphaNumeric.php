<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\Definition;

use function is_null;

/**
 * Class AlphaNumeric
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class AlphaNumeric extends AbstractField
{
    private ?int $length;


    /**
     * Constructor.
     *
     * @param string   $name
     * @param bool     $required
     * @param int|null $length
     */
    public function __construct(string $name, bool $required, ?int $length)
    {
        parent::__construct($name, $required);

        $this->length = $length;
    }

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

        if (is_null($this->length)) {
            return;
        }

        if (mb_strlen($value) > $this->length) {
            $this->throwValidationException("Expected string with max length $this->length", $prefix);
        }
    }
}


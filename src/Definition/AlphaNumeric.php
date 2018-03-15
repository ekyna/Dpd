<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Definition;

/**
 * Class AlphaNumeric
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class AlphaNumeric extends AbstractField
{
    /**
     * @var int
     */
    private $length;


    /**
     * Constructor.
     *
     * @param string $name
     * @param bool   $required
     * @param int    $length
     */
    public function __construct(string $name, bool $required, int $length)
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
                $this->throwValidationException("Value is required", $prefix);
            }

            return;
        }

        if (!is_string($value) || empty($value)) {
            $this->throwValidationException("Unexpected string value", $prefix);
        }

        if (strlen($value) > $this->length) {
            $this->throwValidationException("Expected string with max length $this->length", $prefix);
        }
    }
}


<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\Definition;

/**
 * Class Decimal
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Decimal extends AbstractField
{
    private int $scale;
    private int $precision;


    /**
     * Constructor.
     *
     * @param string $name
     * @param bool   $required
     * @param int    $scale
     * @param int    $precision
     */
    public function __construct(string $name, bool $required, int $scale, int $precision)
    {
        parent::__construct($name, $required);

        $this->scale = $scale;
        $this->precision = $precision;
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

        if (!is_numeric($value)) {
            $this->throwValidationException('Unexpected string value', $prefix);
        }

        $value = (string)$value;

        if (str_contains($value, '.')) {
            list($integer, $decimal) = explode('.', $value);
        } elseif (str_starts_with($value, '.')) {
            $integer = '0';
            $decimal = substr($value, 1);
        } else {
            $integer = $value;
            $decimal = '0';
        }

        if (strlen($integer) > $this->scale) {
            $this->throwValidationException("Expected decimal with max scale $this->scale", $prefix);
        }

        if (strlen($decimal) > $this->precision) {
            $this->throwValidationException("Expected decimal with max precision $this->precision", $prefix);
        }
    }
}

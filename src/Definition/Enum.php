<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\Definition;

use Ekyna\Component\Dpd\EPrint\Enum\EnumInterface;
use Ekyna\Component\Dpd\Exception;

/**
 * Class Enum
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Enum extends AbstractField
{
    private string $class;


    /**
     * Constructor.
     *
     * @param string $name
     * @param bool   $required
     * @param string $class
     */
    public function __construct(string $name, bool $required, string $class)
    {
        parent::__construct($name, $required);

        if (!is_subclass_of($class, EnumInterface::class)) {
            throw new Exception\RuntimeException("Class $class must implements " . EnumInterface::class);
        }

        $this->class = $class;
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

        $allowed = call_user_func([$this->class, 'getValues']);
        if (!in_array($value, $allowed, true)) {
            $this->throwValidationException("Unexpected value '$value'", $prefix);
        }
    }
}

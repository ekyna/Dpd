<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Definition;

use Ekyna\Component\DpdWs\Enum\EnumInterface;
use Ekyna\Component\DpdWs\Exception;

/**
 * Class Enum
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Enum extends AbstractField
{
    /**
     * @var string
     */
    private $class;


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
                $this->throwValidationException("Value is required", $prefix);
            }

            return;
        }

        $allowed = call_user_func([$this->class, 'getValues']);
        if (!in_array($value, $allowed, true)) {
            $this->throwValidationException("Unexpected value '$value'", $prefix);
        }
    }
}

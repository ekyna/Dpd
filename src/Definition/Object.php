<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Definition;

use Ekyna\Component\DpdWs\Model\ModelInterface;
use Ekyna\Component\DpdWs\Exception;

/**
 * Class Object
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Object extends AbstractField
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

        if (!is_subclass_of($class, ModelInterface::class)) {
            throw new Exception\RuntimeException("Class $class must implements " . ModelInterface::class);
        }

        $this->class = $class;
    }

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

        if (!$value instanceof $this->class) {
            $this->throwValidationException("Expected instance of " . $this->class, $prefix);
        }

        /** @var ModelInterface $value  */
        $value->validate($prefix);
    }
}

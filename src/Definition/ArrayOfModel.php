<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\Definition;

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\InputInterface;

/**
 * Class ArrayOfModel
 * @package Ekyna\Component\Dpd\Definition
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ArrayOfModel extends AbstractField
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

        if (!is_subclass_of($class, InputInterface::class)) {
            throw new Exception\RuntimeException("Class $class must implements " . InputInterface::class);
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
                $this->throwValidationException('Value is required', $prefix);
            }

            return;
        }

        if (!is_array($value)) {
            $this->throwValidationException('Expected array value', $prefix);
        }

        foreach ($value as $object) {
            if (!$object instanceof $this->class) {
                $this->throwValidationException('Expected instance of ' . $this->class, $prefix);
            }

            /** @var InputInterface $object */
            $object->validate($prefix);
        }
    }
}

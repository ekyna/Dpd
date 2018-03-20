<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Model;

use Ekyna\Component\Dpd\Definition\Definition;

/**
 * Class AbstractModel
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractInput implements InputInterface
{
    /**
     * @var array
     */
    private static $definitions = [];

    /**
     * @var array
     */
    private $data = [];


    /**
     * @inheritdoc
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @inheritdoc
     */
    public function __isset($name)
    {
        return array_key_exists($name, $this->data);
    }

    /**
     * @inheritdoc
     */
    public function __unset($name)
    {
        unset($this->data[$name]);
    }

    /**
     * @inheritdoc
     */
    public function validate(string $prefix = null): void
    {
        $definition = $this->getDefinition();

        foreach ($definition->getFields() as $name => $field) {
            $value = $this->{$name};

            $field->validate($value, $prefix);
        }
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $data = [];

        $definition = $this->getDefinition();

        foreach ($definition->getFields() as $name => $field) {
            if (is_null($value = $this->{$name})) {
                continue;
            }

            if ($value instanceof InputInterface) {
                $data[$name] = $value->toArray();
            } else {
                $data[$name] = $value;
            }
        }

        return $data;
    }

    /**
     * Returns the definition.
     *
     * @return Definition
     */
    protected function getDefinition(): Definition
    {
        if (isset(self::$definitions[static::class])) {
            return self::$definitions[static::class];
        }

        $definition = new Definition();

        $this->buildDefinition($definition);

        return self::$definitions[static::class] = $definition;
    }

    /**
     * Builds the definition.
     *
     * @param Definition $definition
     */
    abstract protected function buildDefinition(Definition $definition): void;
}
<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Definition;

use Ekyna\Component\Dpd\Exception\DefinitionException;

/**
 * Class Definition
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Definition
{
    /**
     * @var FieldInterface[]
     */
    private $fields = [];


    /**
     * Adds the field.
     *
     * @param FieldInterface $field
     *
     * @return $this|Definition
     */
    public function addField(FieldInterface $field): Definition
    {
        $name = $field->getName();

        if (isset($this->fields[$name])) {
            throw new DefinitionException("Field '$name' is already defined.");
        }

        $this->fields[$name] = $field;

        return $this;
    }

    /**
     * Returns the fields.
     *
     * @return FieldInterface[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}

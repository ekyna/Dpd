<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\Definition;

use Ekyna\Component\Dpd\Exception;

/**
 * Class AbstractField
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractField implements FieldInterface
{
    protected string $name;
    protected bool   $required;


    /**
     * Constructor.
     *
     * @param string $name
     * @param bool   $required
     */
    public function __construct(string $name, bool $required)
    {
        $this->name = $name;
        $this->required = $required;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Throws a validation exception.
     *
     * @param string      $message
     * @param string|null $prefix
     *
     * @throws Exception\ValidationException
     */
    protected function throwValidationException(string $message, string $prefix = null)
    {
        throw new Exception\ValidationException($message, $this->name, $prefix);
    }
}

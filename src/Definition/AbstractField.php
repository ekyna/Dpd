<?php
declare (strict_types=1);

namespace Ekyna\Component\DpdWs\Definition;

use Ekyna\Component\DpdWs\Exception;

/**
 * Class AbstractField
 * @package Ekyna\Component\DpdWs
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractField implements FieldInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $required;


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
     * @param string $message
     * @param string $prefix
     *
     * @throws Exception\ValidationException
     */
    protected function throwValidationException(string $message, string $prefix = null)
    {
        throw new Exception\ValidationException($message, $this->name, $prefix);
    }
}

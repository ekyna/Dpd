<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Exception;

/**
 * Class ValidationException
 * @package Ekyna\Component\Dpd\Exception
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ValidationException extends \InvalidArgumentException implements ExceptionInterface
{
    /**
     * Constructor.
     *
     * @param string $message
     * @param string $name
     * @param string $prefix
     */
    public function __construct(string $message, string $name, string $prefix = null)
    {
        $this->message = sprintf(
            "%s for field '%s'",
            $message,
            empty($prefix) ? $name : $prefix . '.' . $name
        );
    }
}

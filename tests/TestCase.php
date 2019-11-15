<?php

namespace Ekyna\Component\Dpd\Test;

use Ekyna\Component\Dpd\Exception;
use PHPUnit\Framework\TestCase as BaseCase;

/**
 * Class TestCase
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
 */
class TestCase extends BaseCase
{
    protected function expectValidationException()
    {
        $this->expectException(Exception\ValidationException::class);
    }

    protected function expectRuntimeException()
    {
        $this->expectException(Exception\RuntimeException::class);
    }
}

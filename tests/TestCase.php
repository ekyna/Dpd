<?php

declare(strict_types=1);

namespace Ekyna\Component\Dpd\Tests;

use PHPUnit\Framework\TestCase as BaseCase;
use Ekyna\Component\Dpd\Exception;

/**
 * Class TestCase
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
 */
abstract class TestCase extends BaseCase
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

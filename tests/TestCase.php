<?php

namespace Ekyna\Component\DpdWs;

use Ekyna\Component\DpdWs\Exception;


/**
 * Class TestCase
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\DpdWs
 */
class TestCase extends \PHPUnit_Framework_TestCase
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

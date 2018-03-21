<?php

namespace Ekyna\Component\Dpd;

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\AbstractInput;

/**
 * Class TestCase
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
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

/**
 * Class InvalidTestModel
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class InvalidTestModel
{

}

/**
 * Class ValidTestModel
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @property string $test
 */
class ValidTestModel extends AbstractInput
{
    protected function buildDefinition(Definition\Definition $definition): void
    {
        $definition->addField(new Definition\Boolean('test', true));
    }
}
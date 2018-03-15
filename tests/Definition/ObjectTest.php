<?php

namespace Ekyna\Component\DpdWs\Definition;

use Ekyna\Component\DpdWs\Model\AbstractModel;
use Ekyna\Component\DpdWs\TestCase;

/**
 * Class ObjectTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\DpdWs\Test
 */
class ObjectTest extends TestCase
{
    public function test_validate_with_invalid_model()
    {
        $this->expectRuntimeException();

        new Object('test', false, InvalidTestModel::class);
    }

    public function test_validate_with_valid_model()
    {
        new Object('test', false, ValidTestModel::class);

        $this->assertTrue(true);
    }

    public function test_validate_not_required_with_null_value()
    {
        $field = new Object('test', false, ValidTestModel::class);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_null_value()
    {
        $this->expectValidationException();

        $field = new Object('test', true, ValidTestModel::class);
        $field->validate(null);
    }

    public function test_validate_with_non_object_value()
    {
        $this->expectValidationException();

        $field = new Object('test', true, ValidTestModel::class);
        $field->validate('test');
    }

    public function test_validate_with_wrong_value_class()
    {
        $this->expectValidationException();

        $field = new Object('test', true, ValidTestModel::class);
        $field->validate(new InvalidTestModel());
    }

    public function test_validate_with_invalid_value()
    {
        $this->expectValidationException();

        $field = new Object('test', false, ValidTestModel::class);

        $value = new ValidTestModel();
        $field->validate($value);
    }

    public function test_validate_with_valid_value()
    {
        $field = new Object('test', false, ValidTestModel::class);

        $value = new ValidTestModel();
        $value->test = false;

        $field->validate($value);

        $this->assertTrue(true);
    }
}

/**
 * @property string $test
 */
class ValidTestModel extends AbstractModel
{
    protected function buildDefinition(Definition $definition): void
    {
        $definition->addField(new Boolean('test', true));
    }
}

class InvalidTestModel
{

}

<?php

namespace Ekyna\Component\Dpd\Definition;

use Ekyna\Component\Dpd\InvalidTestModel;
use Ekyna\Component\Dpd\ValidTestModel;
use Ekyna\Component\Dpd\TestCase;

/**
 * Class ModelTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd\Test
 */
class ModelTest extends TestCase
{
    public function test_validate_with_invalid_model()
    {
        $this->expectRuntimeException();

        new Model('test', false, InvalidTestModel::class);
    }

    public function test_validate_with_valid_model()
    {
        new Model('test', false, ValidTestModel::class);

        $this->assertTrue(true);
    }

    public function test_validate_not_required_with_null_value()
    {
        $field = new Model('test', false, ValidTestModel::class);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_null_value()
    {
        $this->expectValidationException();

        $field = new Model('test', true, ValidTestModel::class);
        $field->validate(null);
    }

    public function test_validate_with_non_object_value()
    {
        $this->expectValidationException();

        $field = new Model('test', true, ValidTestModel::class);
        $field->validate('test');
    }

    public function test_validate_with_wrong_value_class()
    {
        $this->expectValidationException();

        $field = new Model('test', true, ValidTestModel::class);
        $field->validate(new InvalidTestModel());
    }

    public function test_validate_with_invalid_value()
    {
        $this->expectValidationException();

        $field = new Model('test', false, ValidTestModel::class);

        $model = new ValidTestModel();
        $field->validate($model);
    }

    public function test_validate_with_valid_value()
    {
        $field = new Model('test', false, ValidTestModel::class);

        $model = new ValidTestModel();
        $model->test = false;

        $field->validate($model);

        $this->assertTrue(true);
    }
}

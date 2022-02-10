<?php

namespace Ekyna\Component\Dpd\Tests\Definition;

use Ekyna\Component\Dpd\Definition\ArrayOfModel;
use Ekyna\Component\Dpd\Tests\InvalidTestModel;
use Ekyna\Component\Dpd\Tests\ValidTestModel;
use Ekyna\Component\Dpd\Tests\TestCase;

/**
 * Class ArrayOfModelTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
 */
class ArrayOfModelTest extends TestCase
{
    public function test_validate_with_invalid_model()
    {
        $this->expectRuntimeException();

        new ArrayOfModel('test', false, InvalidTestModel::class);
    }

    public function test_validate_with_valid_model()
    {
        new ArrayOfModel('test', false, ValidTestModel::class);

        $this->assertTrue(true);
    }

    public function test_validate_not_required_with_null_value()
    {
        $field = new ArrayOfModel('test', false, ValidTestModel::class);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_null_value()
    {
        $this->expectValidationException();

        $field = new ArrayOfModel('test', true, ValidTestModel::class);
        $field->validate(null);
    }

    public function test_validate_with_non_array_value()
    {
        $this->expectValidationException();

        $field = new ArrayOfModel('test', true, ValidTestModel::class);
        $field->validate('test');
    }

    public function test_validate_with_wrong_model_class()
    {
        $this->expectValidationException();

        $field = new ArrayOfModel('test', true, ValidTestModel::class);
        $field->validate([new InvalidTestModel()]);
    }

    public function test_validate_with_invalid_value()
    {
        $this->expectValidationException();

        $field = new ArrayOfModel('test', false, ValidTestModel::class);

        $model = new ValidTestModel();
        $field->validate([$model]);
    }

    public function test_validate_with_valid_value()
    {
        $field = new ArrayOfModel('test', false, ValidTestModel::class);

        $model = new ValidTestModel();
        $model->test = false;

        $field->validate([$model]);

        $this->assertTrue(true);
    }
}

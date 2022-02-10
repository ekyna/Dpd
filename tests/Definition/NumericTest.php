<?php

namespace Ekyna\Component\Dpd\Tests\Definition;

use Ekyna\Component\Dpd\Definition\Numeric;
use Ekyna\Component\Dpd\Tests\TestCase;

/**
 * Class NumericTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
 */
class NumericTest extends TestCase
{
    public function test_validate_not_required_with_empty_value()
    {
        $field = new Numeric('test', false, 2);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_empty_value()
    {
        $this->expectValidationException();

        $field = new Numeric('test', true, 2);
        $field->validate(null);
    }

    public function test_validate_required_with_non_Numeric_value()
    {
        $this->expectValidationException();

        $field = new Numeric('test', true, 2);
        $field->validate('test');
    }

    public function test_validate_scale_with_short_value()
    {
        $field = new Numeric('test', true, 2);
        $field->validate('12');

        $this->assertTrue(true);
    }

    public function test_validate_scale_with_long_value()
    {
        $this->expectValidationException();

        $field = new Numeric('test', false, 2);
        $field->validate('123');
    }
}

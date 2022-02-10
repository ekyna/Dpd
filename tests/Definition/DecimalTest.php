<?php

namespace Ekyna\Component\Dpd\Tests\Definition;

use Ekyna\Component\Dpd\Definition\Decimal;
use Ekyna\Component\Dpd\Tests\TestCase;

/**
 * Class DecimalTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
 */
class DecimalTest extends TestCase
{
    public function test_validate_not_required_with_empty_value()
    {
        $field = new Decimal('test', false, 2, 3);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_empty_value()
    {
        $this->expectValidationException();

        $field = new Decimal('test', true, 2, 3);
        $field->validate(null);
    }

    public function test_validate_required_with_non_decimal_value()
    {
        $this->expectValidationException();

        $field = new Decimal('test', true, 2, 3);
        $field->validate('test');
    }

    public function test_validate_scale_with_short_value()
    {
        $field = new Decimal('test', true, 2, 3);
        $field->validate('12.345');

        $this->assertTrue(true);
    }

    public function test_validate_scale_with_long_value()
    {
        $this->expectValidationException();

        $field = new Decimal('test', false, 2, 3);
        $field->validate('123.45');
    }

    public function test_validate_precision_with_short_value()
    {
        $field = new Decimal('test', true, 2, 3);
        $field->validate('12.345');

        $this->assertTrue(true);
    }

    public function test_validate_precision_with_long_value()
    {
        $this->expectValidationException();

        $field = new Decimal('test', false, 2, 3);
        $field->validate('1.2345');
    }
}

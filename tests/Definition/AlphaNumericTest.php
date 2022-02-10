<?php

namespace Ekyna\Component\Dpd\Tests\Definition;

use Ekyna\Component\Dpd\Definition\AlphaNumeric;
use Ekyna\Component\Dpd\Tests\TestCase;

/**
 * Class AlphaNumericTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
 */
class AlphaNumericTest extends TestCase
{
    public function test_validate_not_required_with_empty_value()
    {
        $field = new AlphaNumeric('test', false, 8);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_empty_value()
    {
        $this->expectValidationException();

        $field = new AlphaNumeric('test', true, 8);
        $field->validate(null);
    }

    public function test_validate_with_non_string_value()
    {
        $this->expectValidationException();

        $field = new AlphaNumeric('test', true, 8);
        $field->validate(true);
    }

    public function test_validate_length_with_short_value()
    {
        $field = new AlphaNumeric('test', true, 7);
        $field->validate('success');

        $this->assertTrue(true);
    }

    public function test_validate_length_with_long_value()
    {
        $this->expectValidationException();

        $field = new AlphaNumeric('test', false, 6);
        $field->validate('failure');
    }
}

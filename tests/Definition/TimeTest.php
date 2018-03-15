<?php

namespace Ekyna\Component\Dpd\Definition;

use Ekyna\Component\Dpd\TestCase;

/**
 * Class TimeTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
 */
class TimeTest extends TestCase
{
    public function test_validate_not_required_with_empty_value()
    {
        $field = new Time('test', false);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_empty_value()
    {
        $this->expectValidationException();

        $field = new Time('test', true);
        $field->validate(null);
    }

    public function test_validate_required_with_invalid_value()
    {
        $this->expectValidationException();

        $field = new Time('test', true);
        $field->validate('test');
    }

    public function test_validate_required_with_invalid_time()
    {
        $this->expectValidationException();

        $field = new Time('test', true);
        $field->validate('00-00');
    }

    public function test_validate_required_with_valid_time()
    {
        $field = new Time('test', true);
        $field->validate('00:00');

        $this->assertTrue(true);
    }
}

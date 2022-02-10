<?php

namespace Ekyna\Component\Dpd\Tests\Definition;

use Ekyna\Component\Dpd\Definition\Date;
use Ekyna\Component\Dpd\Tests\TestCase;

/**
 * Class DateTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
 */
class DateTest extends TestCase
{
    public function test_validate_not_required_with_empty_value()
    {
        $field = new Date('test', false);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_empty_value()
    {
        $this->expectValidationException();

        $field = new Date('test', true);
        $field->validate(null);
    }

    public function test_validate_required_with_invalid_value()
    {
        $this->expectValidationException();

        $field = new Date('test', true);
        $field->validate('test');
    }

    public function test_validate_required_with_invalid_date()
    {
        $this->expectValidationException();

        $field = new Date('test', true);
        $field->validate('01-01-2018');
    }

    public function test_validate_required_with_valid_date()
    {
        $field = new Date('test', true);
        $field->validate('01.01.2018');

        $this->assertTrue(true);
    }
}

<?php

namespace Ekyna\Component\DpdWs\Definition;

use Ekyna\Component\DpdWs\TestCase;

/**
 * Class BooleanTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\DpdWs
 */
class BooleanTest extends TestCase
{
    public function test_validate_not_required_with_empty_value()
    {
        $field = new Boolean('test', false);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_empty_value()
    {
        $this->expectValidationException();

        $field = new Boolean('test', true);
        $field->validate(null);
    }

    public function test_validate_required_with_non_bool_value()
    {
        $this->expectValidationException();

        $field = new Boolean('test', true);
        $field->validate('test');
    }

    public function test_validate_required_with_bool_value()
    {
        $field = new Boolean('test', true);
        $field->validate(true);
        $field->validate(false);

        $this->assertTrue(true);
    }
}

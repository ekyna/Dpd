<?php

namespace Ekyna\Component\Dpd\Definition;

use Ekyna\Component\Dpd\Enum\EnumInterface;
use Ekyna\Component\Dpd\TestCase;

/**
 * Class EnumTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
 */
class EnumTest extends TestCase
{
    public function test_constructor_with_invalid_enum()
    {
        $this->expectRuntimeException();

        new Enum('test', false, InvalidTestEnum::class);
    }

    public function test_constructor_with_valid_enum()
    {
        new Enum('test', false, ValidTestEnum::class);

        $this->assertTrue(true);
    }

    public function test_validate_not_required_with_empty_value()
    {
        $field = new Enum('test', false, ValidTestEnum::class);
        $field->validate(null);

        $this->assertTrue(true);
    }

    public function test_validate_required_with_empty_value()
    {
        $this->expectValidationException();

        $field = new Enum('test', true, ValidTestEnum::class);
        $field->validate(null);
    }

    public function test_validate_with_invalid_value()
    {
        $this->expectValidationException();

        $field = new Enum('test', true, ValidTestEnum::class);
        $field->validate('3');
    }

    public function test_validate_with_valid_value()
    {
        $field = new Enum('test', false, ValidTestEnum::class);
        $field->validate('1');
        $field->validate('2');

        $this->assertTrue(true);
    }
}

class ValidTestEnum implements EnumInterface
{
    const VALUE_1 = '1';
    const VALUE_2 = '2';

    public static function getValues(): array
    {
        return [
            static::VALUE_1,
            static::VALUE_2,
        ];
    }
}

class InvalidTestEnum
{

}

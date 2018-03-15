<?php

namespace Ekyna\Component\DpdWs\Model;

use Ekyna\Component\DpdWs\TestCase;

/**
 * Class AddressTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\DpdWs
 */
class AddressTest extends TestCase
{
    public function test_validation_with_invalid_data()
    {
        $this->expectValidationException();

        $address = new Address();
        $address->name = 'Such a super long first and last names';

        $address->validate();
    }

    public function test_validation_with_valid_data()
    {
        $address = new Address();
        $address->name = 'John doe';
        $address->countryPrefix = 'FR';
        $address->zipCode = '12345';
        $address->city = 'City';
        $address->street = 'Street';
        $address->phoneNumber = '12345678';

        $address->validate();

        $this->assertTrue(true);
    }

    public function test_to_array()
    {
        $address = new Address();
        $address->name = 'John doe';
        $address->countryPrefix = 'FR';
        $address->zipCode = '12345';
        $address->city = 'City';
        $address->street = 'Street';
        $address->phoneNumber = '12345678';

        $expected = [
            'name'          => 'John doe',
            'countryPrefix' => 'FR',
            'zipCode'       => '12345',
            'city'          => 'City',
            'street'        => 'Street',
            'phoneNumber'   => '12345678',
        ];

        $actual = $address->toArray();

        $this->assertEquals($expected, $actual);
    }
}

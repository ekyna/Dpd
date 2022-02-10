<?php

namespace Ekyna\Component\Dpd\Tests\EPrint\Model;

use Ekyna\Component\Dpd\EPrint\Model\Address;
use Ekyna\Component\Dpd\Tests\TestCase;

/**
 * Class AddressTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 * @package Ekyna\Component\Dpd
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
        $address->street = 'Chaîne avec ’ caractères spéciaux';
        $address->phoneNumber = '12345678';

        $address->validate();

        $this->assertTrue(true);
    }
}

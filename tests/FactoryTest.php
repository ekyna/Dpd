<?php

namespace Ekyna\Component\Dpd\Test;

use Ekyna\Component\Dpd\Factory;
use Ekyna\Component\Dpd\Relay;
use Ekyna\Component\Dpd\Shipment;
use PHPUnit\Framework\TestCase;

/**
 * Class FactoryTest
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class FactoryTest extends TestCase
{
    /** @var Factory */
    private $factory;

    protected function setUp(): void
    {
        $this->factory = new Factory([
            'carrier' => 'carrier',
            'key'     => 'key',

            'login'    => 'login',
            'password' => 'password',

            'payer_id'            => '11111111',
            'payer_address_id'    => '22222222',
            'sender_id'           => '33333333',
            'sender_address_id'   => '44444444',
            'departure_unit_id'   => '1234',
            'sender_zip_code'     => '12345',
            'sender_country_code' => 'FR',
        ]);
    }

    protected function tearDown(): void
    {
        $this->factory = null;
    }

    public function test_getRelayApi(): void
    {
        // Calling getRelayApi without config will return the default API
        $defaultApi = $this->factory->getRelayApi();
        $this->assertInstanceOf(Relay\Api::class, $defaultApi);
        $this->assertRelayApiClientConfig($defaultApi, 'carrier', 'key');

        // Subsequent calls without config will return the same default API instance
        $sameApi = $this->factory->getRelayApi();
        $this->assertSame($defaultApi, $sameApi);

        // Calling getRelayApi with config will return a custom API
        $customApi = $this->factory->getRelayApi([
            'carrier' => 'foo',
            'key'     => 'bar',
        ]);
        $this->assertInstanceOf(Relay\Api::class, $customApi);
        $this->assertRelayApiClientConfig($customApi, 'foo', 'bar');

        // Subsequent calls with config will return the new custom API instance
        $anotherApi = $this->factory->getRelayApi([
            'carrier' => 'foo',
            'key'     => 'bar',
        ]);
        $this->assertNotSame($customApi, $anotherApi);
    }

    private function assertRelayApiClientConfig(Relay\Api $api, string $carrier, string $key): void
    {
        $class = new \ReflectionClass(Relay\Api::class);
        $property = $class->getProperty('client');
        $property->setAccessible(true);
        $client = $property->getValue($api);

        $class = new \ReflectionClass(Relay\Client::class);

        $property = $class->getProperty('carrier');
        $property->setAccessible(true);
        $this->assertEquals($carrier, $property->getValue($client));

        $property = $class->getProperty('key');
        $property->setAccessible(true);
        $this->assertEquals($key, $property->getValue($client));
        $property->setAccessible(false);
    }

    public function test_getShipmentApi(): void
    {
        // Calling getRelayApi without config will return the default API
        $defaultApi = $this->factory->getShipmentApi();
        $this->assertInstanceOf(Shipment\Api::class, $defaultApi);
        $this->assertShipmentApiClientConfig($defaultApi, 'login', 'password');
        $this->assertShipmentApiCredentialsConfig($defaultApi, '11111111', '33333333');

        // Subsequent calls without config will return the same default API instance
        $sameApi = $this->factory->getShipmentApi();
        $this->assertSame($defaultApi, $sameApi);

        // Calling getRelayApi with config will return a custom API
        $customApi = $this->factory->getShipmentApi([
            'login'     => 'foo',
            'password'  => 'bar',
            'payer_id'  => '99999999',
            'sender_id' => '77777777',
        ]);
        $this->assertInstanceOf(Shipment\Api::class, $customApi);
        $this->assertShipmentApiClientConfig($customApi, 'foo', 'bar');
        $this->assertShipmentApiCredentialsConfig($customApi, '99999999', '77777777');

        // Subsequent calls with config will return the new custom API instance
        $anotherApi = $this->factory->getShipmentApi([
            'login'    => 'foo',
            'password' => 'bar',
        ]);
        $this->assertNotSame($customApi, $anotherApi);
    }

    private function assertShipmentApiClientConfig(Shipment\Api $api, string $login, string $password): void
    {
        $class = new \ReflectionClass(Shipment\Api::class);
        $property = $class->getProperty('client');
        $property->setAccessible(true);
        $client = $property->getValue($api);

        $class = new \ReflectionClass(Shipment\Client::class);

        $property = $class->getProperty('login');
        $property->setAccessible(true);
        $this->assertEquals($login, $property->getValue($client));

        $property = $class->getProperty('password');
        $property->setAccessible(true);
        $this->assertEquals($password, $property->getValue($client));
        $property->setAccessible(false);
    }

    private function assertShipmentApiCredentialsConfig(Shipment\Api $api, string $payerId, string $senderId): void
    {
        $class = new \ReflectionClass(Shipment\Api::class);
        $property = $class->getProperty('credentials');
        $property->setAccessible(true);
        $credentials = $property->getValue($api);

        $class = new \ReflectionClass(Shipment\Model\Credentials::class);

        $property = $class->getProperty('payerId');
        $property->setAccessible(true);
        $this->assertEquals($payerId, $property->getValue($credentials));

        $property = $class->getProperty('senderId');
        $property->setAccessible(true);
        $this->assertEquals($senderId, $property->getValue($credentials));
        $property->setAccessible(false);
    }
}

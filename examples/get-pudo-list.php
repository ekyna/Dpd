<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\Factory;
use Ekyna\Component\Dpd\Relay;

/* ---------------- Get the API ---------------- */

require __DIR__ . '/config.php';
$factory = new Factory($config);
$api = $factory->getRelayApi();

/* ---------------- Create request ---------------- */

$request = new Relay\Request\ListRequest();

$request
    ->setAddress('32 rue de rennes')
    ->setZipCode('35230')
    ->setCity('Noyal-Châtillon-sur-Seiche')
    ->setCountryCode('fr')
    ->setRequestId(uniqid())
    ->setDate(new \DateTime('+1 day'))
    ->setWeight(2)
    //->setMaxDistance(10)
    //->setMaxNumber(10)
    //->setCategory('')
    //->setHoliday(false)
;

/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->getList($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
echo get_class($response) . "\n";

var_dump($response);

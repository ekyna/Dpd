<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\Factory;
use Ekyna\Component\Dpd\Relay;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';
$factory = new Factory($config);
$api = $factory->getRelayApi();

/* ---------------- Create request ---------------- */

$request = new Relay\Request\DetailRequest('P32805');

/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->getDetails($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
echo get_class($response) . "\n";

var_dump($response);

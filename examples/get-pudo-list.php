<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\Pudo;

/* ---------------- Client and API ---------------- */

$config = require __DIR__ . '/config.php';

$api = new Pudo\Api($config['pudo']);

/* ---------------- Create request ---------------- */

$request = new Pudo\Request\GetPudoListRequest();

$request->address = '32 rue de rennes';
$request->zipCode = '35230';
$request->city = 'Noyal-Châtillon-sur-Seiche';
$request->countrycode = 'FR';
$request->requestID = 'test';
$request->date_from = (new DateTime('+1 day'))->format('d/m/Y');


/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->GetPudoList($request);
} catch (Exception\ExceptionInterface $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}
echo get_class($response) . "\n";

var_dump($response);


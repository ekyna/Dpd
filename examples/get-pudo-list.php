<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\Pudo;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new Pudo\Api($pudoConfig);

/* ---------------- Create request ---------------- */

$request = new Pudo\Request\GetPudoListRequest();

$request->address = '2 rue des perrets';
$request->zipCode = '35690';
$request->city = 'Acigné';
$request->countrycode = 'FR';
$request->requestID = 'FR';
$request->date_from = (new \DateTime('+1 day'))->format('d/m/Y');


/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var \Ekyna\Component\Dpd\Pudo\Response\GetPudoListResponse $response */
    $response = $api->GetPudoList($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
echo get_class($response) . "\n";

var_dump($response);


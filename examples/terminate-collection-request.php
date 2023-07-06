<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

$config = require __DIR__ . '/config.php';

$api = new EPrint\Api($config['eprint']);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\TerminateCollectionRequestBcRequest();

$request->barcode = '250077964427540017';

$request->customer = new EPrint\Model\Customer();
$request->customer->centernumber = $config['center_number'];
$request->customer->countrycode = $config['country_code'];
$request->customer->number = $config['customer_number'];

/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->TerminateCollectionRequestBc($request);
} catch (Exception\ExceptionInterface $e) {
    dump_error($e);
    throw $e;
}

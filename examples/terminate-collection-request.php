<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new EPrint\Api($ePrintConfig);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\TerminateCollectionRequestRequest();

$request->parcel = new EPrint\Model\Parcel();
$request->parcel->parcelnumber = '123456789';
$request->parcel->countrycode = $countryCode;
$request->parcel->centernumber = $centerNumber;

$request->customer = new EPrint\Model\Customer();
$request->customer->number = $usePredict ? $predictNumber : $classicNumber;
$request->customer->countrycode = $countryCode;
$request->customer->centernumber = $centerNumber;

/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->TerminateCollectionRequest($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    if ($debug && $e instanceof Exception\ClientException) {
        echo "\nRequest:\n" . $e->request;
        echo "\nResponse:\n" . $e->response;
    }
    exit();
}
echo get_class($response) . "\n";

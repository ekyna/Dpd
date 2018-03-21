<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

// SOAP Client
$client = new Dpd\Client($userId, $password, $cache, $debug);

// API helper
$api = new Dpd\Api($client);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new Dpd\Request\ShipmentRequest();

$request->parcel = new Dpd\Model\Parcel();
$request->parcel->parcelnumber = '801011158';
$request->parcel->countrycode = '250'; // TODO is that same as Customer.countrycode ?
$request->parcel->centernumber = '35'; // TODO is that same as Customer.centernumber ?

$request->customer = new Dpd\Model\Customer();
$request->customer->number = $classicNumber; // or $predictNumber
$request->customer->countrycode = $countryCode;
$request->customer->centernumber = $centerNumber;

/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var Dpd\Response\GetShipmentResponse $response */
    $response = $api->GetShipment($request);
} catch (Dpd\Exception\ClientException $e) {
    echo "Error: " . $e->getMessage();
    if ($debug) {
        echo "\nRequest:\n" . $e->request;
        echo "\nResponse:\n" . $e->response;
    }
    exit();
}
echo get_class($response) . "\n";

// Get result
/** @var Dpd\Model\ShipmentDataExtended $result */
$result = $response->GetShipmentResult;
echo get_class($result) . "\n";

echo <<<EOF
Country code: {$result->countrycode}
Center number: {$result->centernumber}
Parcel number: {$result->parcelnumber}

Weight: {$result->weight}
Date: {$result->shipping_date}

Reference 1: {$result->referencenumber}
Reference 2: {$result->reference2}
Reference 3: {$result->reference3}

Receiver address:
    {$result->receiveraddress->name}
    {$result->receiveraddress->street}
    {$result->receiveraddress->zipCode} {$result->receiveraddress->city}, {$result->receiveraddress->countryPrefix}
    {$result->receiveraddress->phoneNumber}
    [{$result->receiveraddress->geoX}, {$result->receiveraddress->geoY}]

EOF;

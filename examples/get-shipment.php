<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new EPrint\Api($ePrintConfig);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\ShipmentRequest();

$request->parcel = new EPrint\Model\Parcel();
$request->parcel->parcelnumber = '801011158';
$request->parcel->countrycode = $countryCode;
$request->parcel->centernumber = $centerNumber;

$request->customer = new EPrint\Model\Customer();
$request->customer->number = $usePredict ? $predictNumber : $classicNumber;
$request->customer->countrycode = $countryCode;
$request->customer->centernumber = $centerNumber;

/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var \Ekyna\Component\Dpd\EPrint\Response\GetShipmentResponse $response */
    $response = $api->GetShipment($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    if ($debug && $e instanceof Exception\ClientException) {
        echo "\nRequest:\n" . $e->request;
        echo "\nResponse:\n" . $e->response;
    }
    exit();
}
echo get_class($response) . "\n";

// Get result
/** @var \Ekyna\Component\Dpd\EPrint\Model\ShipmentDataExtended $result */
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

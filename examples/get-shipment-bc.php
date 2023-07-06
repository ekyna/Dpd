<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

$config = require __DIR__ . '/config.php';

$api = new EPrint\Api($config['eprint']);

/* ---------------- Create request ---------------- */

$customer = new EPrint\Model\Customer();
$customer->centernumber = $config['center_number'];
$customer->countrycode = $config['country_code'];
$customer->number = $config['customer_number'];

// Shipment request
$request = new EPrint\Request\ShipmentRequestBc();
$request->BarcodeId = '10770400006243';
$request->customer = $customer;

/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->GetShipmentBc($request);
} catch (Exception\ExceptionInterface $exception) {
    dump_error($exception);
    throw $exception;
}

// Get result
$result = $response->GetShipmentBcResult;
echo get_class($result) . "\n";

echo <<<EOF
BarcodeId: {$result->BarcodeId}
Barcode: {$result->Barcode}
BarcodeSource: {$result->BarcodeSource}

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

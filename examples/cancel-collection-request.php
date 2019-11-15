<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Shipment\Factory;
use Ekyna\Component\Dpd\Shipment\Request;
use Ekyna\Component\Dpd\Exception;


/* ---------------- Get the API ---------------- */

require __DIR__ . '/config.php';
$factory = new Factory($shipmentConfig);
$api = $factory->getApi();


/* ---------------- Create shipment with label ---------------- */

$parcelNumber = ""; // TODO set the parcel number
if (empty($parcelNumber)) {
    throw new \RuntimeException("Please set the parcel number.");
}

echo "Canceling collection request...\n";

$request = new Request\CancelCollectionRequest();
$request->setParcelNumber($parcelNumber);

try {
    $response = $api->cancelCollectionRequest($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Failed to cancel collection request: " . $e->getMessage();
    exit;
}

echo "Status: {$response->getReqStatus()}";

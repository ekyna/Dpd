<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\Factory;
use Ekyna\Component\Dpd\Shipment\Request;


/* ---------------- Get the API ---------------- */

require __DIR__ . '/config.php';
$factory = new Factory($config);
$api = $factory->getShipmentApi();


/* ---------------- Create shipment with label ---------------- */

$parcelNumber = "10770941397120"; // TODO set the parcel number
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

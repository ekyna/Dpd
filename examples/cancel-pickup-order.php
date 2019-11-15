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

$callId = ""; // TODO set the call id
if (empty($callId)) {
    throw new \RuntimeException("Please set the call id.");
}

echo "Canceling pickup order...\n";

$request = new Request\CancelPickupOrderRequest();
$request->setCallId($callId);

try {
    $response = $api->cancelPickupOrder($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Failed to cancel pickup order: " . $e->getMessage();
    exit;
}

echo "Message: {$response->getResponseMessage()}\nCallId: {$response->getCallId()}";
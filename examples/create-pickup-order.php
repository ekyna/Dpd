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

echo "Creating pickup order...\n";

$request = new Request\CreatePickupOrderRequest();
$request
    ->setContactPerson("John Doe")
    ->setFromDate((new \DateTime("next monday"))->setTime(14, 0))
    ->setToDate((new \DateTime("next monday"))->setTime(18, 0));

try {
    $response = $api->createPickupOrder($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Failed to create pickup order: " . $e->getMessage();
    exit;
}

echo "Message: {$response->getResponseMessage()}\nCallId: {$response->getCallId()}";
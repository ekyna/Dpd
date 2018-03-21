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
$request = new Dpd\Request\ReverseShipmentRequest();

$request->customer_centernumber = $centerNumber;
$request->customer_countrycode = $countryCode;

if ($usePredict) {
    // Predict
    $request->customer_number = $predictNumber;

    // Predict contact
    $request->services = new Dpd\Model\ReverseInverseServices();
    $request->services->contact = new Dpd\Model\Contact();
    $request->services->contact->type = Dpd\Enum\ETypeContact::PREDICT;
    $request->services->contact->sms = '0635225960';
} else {
    // Classic
    $request->customer_number = $classicNumber;
}

// Receiver address
$request->receiveraddress = new Dpd\Model\Address();
$request->receiveraddress->name = 'Example';
$request->receiveraddress->countryPrefix = 'FR';
$request->receiveraddress->zipCode = '22100';
$request->receiveraddress->city = 'Dinan';
$request->receiveraddress->street = '3 rue sainte-clare';
$request->receiveraddress->phoneNumber = '0633333333';

// (Optional) Receiver address optional info
$request->receiverinfo = new Dpd\Model\AddressInfo();
$request->receiverinfo->vinfo1 = 'Complément adresse';

// Shipper address
$request->shipperaddress = new Dpd\Model\Address();
$request->shipperaddress->name = 'John Doe';
$request->shipperaddress->countryPrefix = 'FR';
$request->shipperaddress->zipCode = '35000';
$request->shipperaddress->city = 'Rennes';
$request->shipperaddress->street = '2 rue saint-louis';
$request->shipperaddress->phoneNumber = '0622222222';

// Shipment weight and expire offset
$request->weight = 1.2; // kg
$request->expire_offset = 3; // days

// (Optional) Theoretical shipment date ('d/m/Y' or 'd.m.Y')
$request->shippingdate = (new \DateTime('+1 day'))->format('d/m/Y');

// (Optional) References and comment
$request->referencenumber = 'return_ref_1';

/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var Dpd\Response\CreateReverseInverseShipmentResponse $response */
    $response = $api->CreateReverseInverseShipment($request);
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
/** @var Dpd\Model\Shipment $shipment */
$shipment = $response->CreateReverseInverseShipmentResult;
echo get_class($shipment) . "\n";

echo "Tracking URL: {$shipment->getTrackingUrl()}\n";

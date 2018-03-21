<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Api;
use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new Api($apiConfig);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\MultiShipmentRequest();
$request->customer_centernumber = $centerNumber;
$request->customer_countrycode = $countryCode;

if ($usePredict) {
    // Predict
    $request->customer_number = $predictNumber;

    // Predict contact
    $request->services = new EPrint\Model\MultiServices();
    $request->services->contact = new EPrint\Model\Contact();
    $request->services->contact->type = EPrint\Enum\ETypeContact::PREDICT;
    $request->services->contact->sms = '0611111111';
} else {
    // Classic
    $request->customer_number = $classicNumber;
}

// Receiver address
$request->receiveraddress = new EPrint\Model\Address();
$request->receiveraddress->name = 'John Doe';
$request->receiveraddress->countryPrefix = 'FR';
$request->receiveraddress->zipCode = '35000';
$request->receiveraddress->city = 'Rennes';
$request->receiveraddress->street = '2 rue saint-louis';
$request->receiveraddress->phoneNumber = '0622222222';

// Receiver address optional info
$request->receiverinfo = new EPrint\Model\AddressInfo();
$request->receiverinfo->vinfo1 = 'Complément adresse';

// Shipper address
$request->shipperaddress = new EPrint\Model\Address();
$request->shipperaddress->name = 'Example';
$request->shipperaddress->countryPrefix = 'FR';
$request->shipperaddress->zipCode = '22100';
$request->shipperaddress->city = 'Dinan';
$request->shipperaddress->street = '3 rue sainte-clare';
$request->shipperaddress->phoneNumber = '0633333333';

// First slave shipment
$slave = new EPrint\Model\SlaveRequest();
$slave->weight = 1.1; // kg
$slave->referencenumber = 'slave_1_ref_1';
$slave->reference2 = 'slave_1_ref_2';
$slave->reference3 = 'slave_1_ref_3';
$request->addSlave($slave);

// Second slave shipment
$slave = new EPrint\Model\SlaveRequest();
$slave->weight = 1.2; // kg
$slave->referencenumber = 'slave_2_ref_1';
$slave->reference2 = 'slave_2_ref_2';
$slave->reference3 = 'slave_2_ref_3';
$request->addSlave($slave);

// [...]

// (Optional) Theoretical shipment date ('d/m/Y' or 'd.m.Y')
$request->shippingdate = date('d/m/Y');


/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var \Ekyna\Component\Dpd\EPrint\Response\CreateMultiShipmentResponse $response */
    $response = $api->CreateMultiShipment($request);
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
/** @var \Ekyna\Component\Dpd\EPrint\Model\MultiShipment $result */
$result = $response->CreateMultiShipmentResult;
echo get_class($result) . "\n";

// Master shipment
//$masterShipment = $result->mastershipment;
//echo get_class($masterShipment) . "\n";
//// Master shipment tracking url:
//echo "Tracking Url: {$masterShipment->getTrackingUrl()}\n";

// Get slaves shipments
/** @var \Ekyna\Component\Dpd\EPrint\Model\Shipment $slaveShipment */
foreach ($result->shipments as $slaveShipment) {
    echo get_class($slaveShipment) . "\n";

    // Slave shipment tracking url:
    echo "Tracking Url: {$slaveShipment->getTrackingUrl()}\n";
}

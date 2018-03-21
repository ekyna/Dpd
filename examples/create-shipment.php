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
$request = new EPrint\Request\StdShipmentRequest();
$request->customer_centernumber = $centerNumber;
$request->customer_countrycode = $countryCode;

if ($usePredict) {
    // Predict
    $request->customer_number = $predictNumber;

    // Predict contact
    $request->services = new EPrint\Model\StdServices();
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

// (Optional) Receiver address optional info
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

// Shipment weight
$request->weight = 1.2; // kg

// (Optional) Theoretical shipment date ('d/m/Y' or 'd.m.Y')
$request->shippingdate = date('d/m/Y');

// (Optional) References and comment
$request->referencenumber = 'my_ref_1';
$request->reference2 = 'my_ref_2';
$request->reference3 = 'my_ref_3';


/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var \Ekyna\Component\Dpd\EPrint\Response\CreateShipmentResponse $response */
    $response = $api->CreateShipment($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    if ($debug && $e instanceof Exception\ClientException) {
        echo "\nRequest:\n" . $e->request;
        echo "\nResponse:\n" . $e->response;
    }
    exit();
}
echo get_class($response) . "\n";


// Get result model
/** @var \Ekyna\Component\Dpd\EPrint\Model\ArrayOfShipment $result */
$result = $response->CreateShipmentResult;
echo get_class($result) . "\n";

// Get shipments
$idx = 1;
/** @var \Ekyna\Component\Dpd\EPrint\Model\Shipment $shipment */
foreach ($result as $shipment) {
    echo get_class($shipment) . "\n";

    // Tracking url:
    echo "Shipment #$idx tracking url: {$shipment->getTrackingUrl()}\n";
}




/*$result = $api->isAlive();
echo var_export($result, true);

$result = $api->getInfo();
echo var_export($result, true);*/

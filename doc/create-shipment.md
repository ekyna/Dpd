### Create shipment

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use Ekyna\Component\Dpd;


/* ---------------- Configure ---------------- */

// TODO Configure
$userId = '';
$password = '';
$classicNumber = '';
$predictNumber = '';
$centerNumber = '';
$countryCode = '';

$cache = false;
$debug = true;

// SOAP client
$client = new Dpd\Client($userId, $password, $cache, $debug);

// API helper
$api = new Dpd\Api($client);

$usePredict = false;


/* ---------------- Create request ---------------- */

$request = new Dpd\Request\StdShipmentRequest();
$request->customer_centernumber = $centerNumber;
$request->customer_countrycode = $countryCode;

if ($usePredict) {
    // Predict
    $request->customer_number = $predictNumber;

    // Predict contact
    $request->services = new Dpd\Model\StdServices();
    $request->services->contact = new Dpd\Model\Contact();
    $request->services->contact->type = Dpd\Enum\ETypeContact::PREDICT;
    $request->services->contact->sms = '0611111111';
} else {
    // Classic
    $request->customer_number = $classicNumber;
}

// Recipient address
$request->receiveraddress = new Dpd\Model\Address();
$request->receiveraddress->name = 'John Doe';
$request->receiveraddress->countryPrefix = 'FR';
$request->receiveraddress->zipCode = '35000';
$request->receiveraddress->city = 'Rennes';
$request->receiveraddress->street = '2 rue saint-louis';
$request->receiveraddress->phoneNumber = '0622222222';

// (Optional) Receiver address info
$request->receiverinfo = new Dpd\Model\AddressInfo();
$request->receiverinfo->vinfo1 = 'Complément adresse';

// Sender address
$request->shipperaddress = new Dpd\Model\Address();
$request->shipperaddress->name = 'Example';
$request->shipperaddress->countryPrefix = 'FR';
$request->shipperaddress->zipCode = '22100';
$request->shipperaddress->city = 'Dinan';
$request->shipperaddress->street = '3 rue sainte-clare';
$request->shipperaddress->phoneNumber = '0633333333';

// Weight
$request->weight = '1.2'; // kg

// (Optional) Theoretical shipment date ('d/m/Y' or 'd.m.Y')
$request->shippingdate = date('d/m/Y');

// (Optional) Your references and comment
$request->referencenumber = 'my_ref_1';
$request->reference2 = 'my_ref_2';
$request->reference3 = 'my_ref_3';


/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var Dpd\Response\CreateShipmentResponse $response */
    $response = $api->CreateShipment($request);
} catch (Dpd\Exception\ClientException $e) {
    echo "Error: " . $e->getMessage();
    if ($debug) {
        echo "\nRequest:\n" . $e->request;
        echo "\nResponse:\n" . $e->response;
    }
    exit();
}

// Result
/** @var Dpd\Model\ArrayOfShipment $result */
$result = $response->CreateShipmentResult;

// Shipments
$idx = 1;
/** @var Dpd\Model\Shipment $shipment */
foreach ($result->shipments as $shipment) {
    // Tracking url:
    echo "Shipment #$idx tracking url: {$shipment->getTrackingUrl()}\n";
}
```
<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new EPrint\Api($ePrintConfig);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\CollectionRequestRequest();
$request->customer_centernumber = $centerNumber;
$request->customer_countrycode = $countryCode;
$request->customer_number = $usePredict ? $predictNumber : $classicNumber; // TODO classic or predict ?

// Collection contact
$request->services = new EPrint\Model\CollectionRequestServices();

$request->services->contact = new EPrint\Model\ContactCollectionRequest();
$request->services->contact->shipper_email = 'test@example.org';
$request->services->contact->shipper_mobil = '0611111111';
$request->services->contact->type = EPrint\Enum\ETypeContact::NO; // TODO Which constant ?

//$request->services->extraInsurance = new EPrint\Model\ExtraInsurance(); // TODO How do insurance works ?
//$request->services->extraInsurance->type = EPrint\Enum\ETypeInsurance::BY_WEIGHT;
//$request->services->extraInsurance->value = '100';


// Receiver address
$request->receiveraddress = new EPrint\Model\Address();
$request->receiveraddress->name = 'Example';
$request->receiveraddress->countryPrefix = 'FR';
$request->receiveraddress->zipCode = '22100';
$request->receiveraddress->city = 'Dinan';
$request->receiveraddress->street = '3 rue sainte-clare';
$request->receiveraddress->phoneNumber = '0633333333';

// Shipper address
$request->shipperaddress = new EPrint\Model\Address();
$request->shipperaddress->name = 'John Doe';
$request->shipperaddress->countryPrefix = 'FR';
$request->shipperaddress->zipCode = '35000';
$request->shipperaddress->city = 'Rennes';
$request->shipperaddress->street = '2 rue saint-louis';
$request->shipperaddress->phoneNumber = '0622222222';

// Config
$request->parcel_count = 1;
$request->pick_date = (new \DateTime('+1 day'))->format('d/m/Y');
$request->time_from = '09:00';
$request->time_to = '12:00';
//$request->remark = '';
//$request->pick_remark = '';
//$request->delivery_remark = '';
//$request->dayCheckDone = null;

// (Optional) References and comment
$request->referencenumber = 'my_ref_1';
$request->reference2 = 'my_ref_2';
$request->reference3 = 'my_ref_3';



/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->CreateCollectionRequest($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    if ($debug && $e instanceof Exception\ClientException) {
        echo "\nRequest:\n" . $e->request;
        echo "\nResponse:\n" . $e->response;
    }
    exit();
}
echo get_class($response) . "\n";

// Get shipments
$idx = 1;
/** @var \Ekyna\Component\Dpd\EPrint\Model\Shipment $shipment */
foreach ($response->CreateCollectionRequestResult as $shipment) {
    echo get_class($shipment) . "\n";

    // Tracking url:
    echo "Shipment#$idx tracking url: {$shipment->getTrackingUrl()}\n";
}


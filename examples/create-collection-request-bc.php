<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

$config = require __DIR__ . '/config.php';

$api = new EPrint\Api($config['eprint']);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\CollectionRequestRequest();
$request->customer_centernumber = $config['center_number'];
$request->customer_countrycode = $config['country_code'];
$request->customer_number = $config['customer_number'];

// Collection contact
$request->services = new EPrint\Model\CollectionRequestServices();
$request->services->contact = new EPrint\Model\ContactCollectionRequest();
$request->services->contact->type = EPrint\Enum\ETypeContact::AUTOMATIC_SMS;
$request->services->contact->sms = '0611111111';

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
$request->pick_date = (new DateTime('+1 day'))->format('d/m/Y');
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
    $response = $api->CreateCollectionRequestBc($request);
} catch (Exception\ExceptionInterface $e) {
    dump_error($e);
    throw $e;
}

// Get shipments
$idx = 0;
foreach ($response->CreateCollectionRequestBcResult as $shipment) {
    $idx++;
    echo <<<EOT
Shipment #$idx
 - barcode: {$shipment->Shipment->BarCode}
 - barcodeId: {$shipment->Shipment->BarcodeId}
 - tracking: {$shipment->getTrackingUrl()}

EOT;
}

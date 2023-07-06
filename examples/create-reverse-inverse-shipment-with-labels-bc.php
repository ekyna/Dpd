<?php

/** TODO Not working */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

$config = require __DIR__ . '/config.php';

$api = new Eprint\Api($config['eprint']);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\ReverseShipmentLabelRequest();
$request->customer_centernumber = $config['center_number'];
$request->customer_countrycode = $config['country_code'];
$request->customer_number = $config['customer_number'];

$request->services = new EPrint\Model\ReverseInverseServices();
// Contact
$request->services->contact = new EPrint\Model\Contact();
$request->services->contact->type = EPrint\Enum\ETypeContact::AUTOMATIC_SMS;
$request->services->contact->sms = '0611111111';

// Receiver address
$request->receiveraddress = new EPrint\Model\Address();
$request->receiveraddress->name = 'Example';
$request->receiveraddress->countryPrefix = 'FR';
$request->receiveraddress->zipCode = '22100';
$request->receiveraddress->city = 'Dinan';
$request->receiveraddress->street = '3 rue sainte-clare';
$request->receiveraddress->phoneNumber = '0633333333';

// (Optional) Receiver address optional info
$request->receiverinfo = new EPrint\Model\AddressInfo();
$request->receiverinfo->vinfo1 = 'Complément adresse';

// Shipper address
$request->shipperaddress = new EPrint\Model\Address();
$request->shipperaddress->name = 'John Doe';
$request->shipperaddress->countryPrefix = 'FR';
$request->shipperaddress->zipCode = '35000';
$request->shipperaddress->city = 'Rennes';
$request->shipperaddress->street = '2 rue saint-louis';
$request->shipperaddress->phoneNumber = '0622222222';

$request->labelType = new EPrint\Model\LabelType();
$request->labelType->type = $type = EPrint\Enum\ELabelType::PDF;

// Shipment weight and expire offset
$request->weight = 1.2; // kg
$request->expire_offset = 7; // days (from shippingdate, min 7)
$request->refasbarcode = true;

// (Optional) Theoretical shipment date ('d/m/Y' or 'd.m.Y')
$request->shippingdate = (new DateTime('+1 day'))->format('d/m/Y');

// (Optional) References and comment
$request->referencenumber = 'return_ref_1';

/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->CreateReverseInverseShipmentWithLabelsBc($request);
} catch (Exception\ExceptionInterface $exception) {
    dump_error($exception);
    throw $exception;
}

// Get result model
$result = $response->CreateReverseInverseShipmentWithLabelsBcResult;

echo <<<EOT
Shipment 
 - number: {$result->Shipment->Shipment->BarcodeId}
 - tracking: {$result->Shipment->getTrackingUrl()}
EOT;

dump_labels(pathinfo(__FILE__, PATHINFO_FILENAME), $type, $result->Labels);

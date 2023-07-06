<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\EPrint;
use Ekyna\Component\Dpd\Exception;

/* ---------------- Client and API ---------------- */

$config = require __DIR__ . '/config.php';

$api = new EPrint\Api($config['eprint']);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\StdShipmentLabelRequest();
$request->customer_centernumber = $config['center_number'];
$request->customer_countrycode = $config['country_code'];
$request->customer_number = $config['customer_number'];

$request->services = new EPrint\Model\StdServices();
$request->services->contact = new EPrint\Model\Contact();
$request->services->contact->type = EPrint\Enum\ETypeContact::PREDICT;
$request->services->contact->sms = '0611111111';


// (Optional) Label type: PNG, PDF, ZPL, etc
$request->labelType = new EPrint\Model\LabelType();
$request->labelType->type = $type = EPrint\Enum\ELabelType::PDF;

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

// (Optional) Insurance
$request->services->extraInsurance = new EPrint\Model\ExtraInsurance();
$request->services->extraInsurance->type = EPrint\Enum\ETypeInsurance::BY_SHIPMENTS; // Always use this const
$request->services->extraInsurance->value = '100'; // 22k euros max

// (Optional) References and comment
$request->referencenumber = 'my_ref_1';
$request->reference2 = 'my_ref_2';
$request->reference3 = 'my_ref_3';
$request->customLabelText = 'Shipping comment...';


/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->CreateShipmentWithLabelsBc($request);
} catch (Exception\ExceptionInterface $exception) {
    dump_error($exception);
    throw $exception;
}

// Get result model
$result = $response->CreateShipmentWithLabelsBcResult;

// Get shipments
$idx = 0;
foreach ($result->shipments as $shipment) {
    $idx++;
    echo <<<EOT
Shipment #$idx
 - number: {$shipment->Shipment->BarcodeId}
 - tracking: {$shipment->getTrackingUrl()}

EOT;
}

dump_labels(pathinfo(__FILE__, PATHINFO_FILENAME), $type, $result->labels);

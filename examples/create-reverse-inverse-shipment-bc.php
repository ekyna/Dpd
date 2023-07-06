<?php

/** TODO Not working */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

$config = require __DIR__ . '/config.php';

$api = new EPrint\Api($config['eprint']);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\ReverseShipmentRequest();
$request->customer_centernumber = $config['center_number'];
$request->customer_countrycode = $config['country_code'];
$request->customer_number = $config['customer_number'];

// Contact
$request->services = new EPrint\Model\ReverseInverseServices();
$request->services->contact = new EPrint\Model\Contact();
$request->services->contact->type = EPrint\Enum\ETypeContact::AUTOMATIC_SMS;
$request->services->contact->sms = '0611111111';
$request->services->contact->email = 'test@exmaple.org';

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

// Shipment weight and expire offset
$request->weight = '1.2'; // kg
$request->expire_offset = 100; // days (from shippingdate, min 7)

// (Optional) Theoretical shipment date ('d/m/Y' or 'd.m.Y')
$request->shippingdate = (new DateTime('+1 day'))->format('d.m.Y');

// (Optional) References and comment
$request->referencenumber = 'return_ref_1';

/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->CreateReverseInverseShipmentBc($request);
} catch (Exception\ExceptionInterface $exception) {
    dump_error($exception);
    throw $exception;
}

// Get result
$shipment = $response->CreateReverseInverseShipmentBcResult;

echo <<<EOT
Shipment
 - number: {$shipment->Shipment->BarcodeId}
 - tracking: {$shipment->getTrackingUrl()}

EOT;

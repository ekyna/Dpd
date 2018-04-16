<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new Eprint\Api($ePrintConfig);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\ReverseShipmentLabelRequest();

$request->customer_centernumber = $centerNumber;
$request->customer_countrycode = $countryCode;

if ($usePredict) {
    // Predict
    $request->customer_number = $predictNumber;

    // Predict contact
    $request->services = new EPrint\Model\ReverseInverseServices();
    $request->services->contact = new EPrint\Model\Contact();
    $request->services->contact->type = EPrint\Enum\ETypeContact::PREDICT;
    $request->services->contact->sms = '0611111111';
} else {
    // Classic
    $request->customer_number = $classicNumber;
}

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
$request->weight = 1.2; // kg
$request->expire_offset = 7; // days (from shippingdate, min 7)
$request->refasbarcode = true;

// (Optional) Theoretical shipment date ('d/m/Y' or 'd.m.Y')
$request->shippingdate = (new \DateTime('+1 day'))->format('d/m/Y');

// (Optional) References and comment
$request->referencenumber = 'return_ref_1';

/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var \Ekyna\Component\Dpd\EPrint\Response\CreateReverseInverseShipmentWithLabelsResponse $response */
    $response = $api->CreateReverseInverseShipmentWithLabels($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    if ($debug && $e instanceof Exception\ClientException) {
        echo "\nRequest:\n" . $e->request;
        echo "\nResponse:\n" . $e->response;
    }
    exit();
}
echo get_class($response) . "\n";

// Result
/** @var \Ekyna\Component\Dpd\EPrint\Model\ShipmentWithLabels $result */
$result = $response->CreateReverseInverseShipmentWithLabelsResult;
echo get_class($result) . "\n";

// Shipment
$shipment = $result->shipment;

echo "Tracking URL: {$shipment->getTrackingUrl()}\n";

// Labels
/** @var \Ekyna\Component\Dpd\EPrint\Model\Label $label */
$idx = 0;
foreach ($result->labels as $label) {
    $idx++;
    echo "Label#$idx: " . strlen($label->label) . " (" . $label->type . ")\n";

    if (false === $im = imagecreatefromstring($label->label)) {
        throw new \Exception("Failed to retrieve the shipment label data.");
    }

    $filename = $labelDir . DIRECTORY_SEPARATOR . sprintf('%s_%s.png', 'reference', $idx);

    if (file_exists($filename)) unlink($filename);

    imagepng($im, $filename);
    imagedestroy($im);
}

<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new EPrint\Api($ePrintConfig);

$relayPoint = "P50124";

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\StdShipmentLabelRequest();
$request->customer_centernumber = $centerNumber;
$request->customer_countrycode = $countryCode;

$request->services = new EPrint\Model\StdServices();

if ($usePredict) {
    // Predict
    $request->customer_number = $predictNumber;

    // Predict contact
    $request->services->contact = new EPrint\Model\Contact();
    $request->services->contact->type = EPrint\Enum\ETypeContact::PREDICT;
    $request->services->contact->sms = '0611111111';
} else {
    // Classic
    $request->customer_number = $classicNumber;
}

// (Optional) Label type: PNG, PDF, PDF_A6
$request->labelType = new EPrint\Model\LabelType();
$request->labelType->type = $type = EPrint\Enum\ELabelType::PDF_A6;

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

// Relay point
if (!$usePredict && !empty($relayPoint)) {
    $request->services = new EPrint\Model\StdServices();
    $request->services->parcelshop = new EPrint\Model\ParcelShop();
    $request->services->parcelshop->shopaddress = new EPrint\Model\ShopAddress();
    $request->services->parcelshop->shopaddress->shopid = $relayPoint;
}

/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var \Ekyna\Component\Dpd\EPrint\Response\CreateShipmentWithLabelsResponse $response */
    $response = $api->CreateShipmentWithLabels($request);
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
/** @var \Ekyna\Component\Dpd\EPrint\Model\ShipmentsWithLabels $result */
$result = $response->CreateShipmentWithLabelsResult;
echo get_class($result) . "\n";

// Get shipments
$idx = 0;
/** @var \Ekyna\Component\Dpd\EPrint\Model\Shipment $shipment */
foreach ($result->shipments as $shipment) {
    $idx++;
    // Tracking url:
    echo "Shipment#$idx tracking url: {$shipment->getTrackingUrl()}\n";
}

// Get label model
/** @var \Ekyna\Component\Dpd\EPrint\Model\Label $label */
$idx = 0;
foreach ($result->labels as $label) {
    $idx++;
    echo "Label#$idx: " . strlen($label->label) . " (" . $label->type . ")\n";

    if ($type === EPrint\Enum\ELabelType::PNG) {
        if (false === $im = imagecreatefromstring($label->label)) {
            throw new \Exception("Failed to retrieve the shipment label data.");
        }

        $filename = $labelDir . DIRECTORY_SEPARATOR . sprintf('reference_%s.png', $idx);

        if (file_exists($filename)) unlink($filename);

        imagepng($im, $filename);
        imagedestroy($im);
    } else {
        $filename = $labelDir . DIRECTORY_SEPARATOR . sprintf('reference_%s.pdf', $idx);

        if (file_exists($filename)) unlink($filename);

        file_put_contents($filename, $label->label);
    }
}

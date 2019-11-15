<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Shipment\Factory;
use Ekyna\Component\Dpd\Shipment\Model;
use Ekyna\Component\Dpd\Shipment\Request;
use Ekyna\Component\Dpd\Exception;


/* ---------------- Get the API ---------------- */

require __DIR__ . '/config.php';
$factory = new Factory($shipmentConfig);
$api = $factory->getApi();


/* ---------------- Reprint shipment label ---------------- */

$parcelNumber = ""; // TODO Set the parcel number
if (empty($parcelNumber)) {
    throw new \Exception("Please set the parcel number.");
}

echo "Reprinting shipment label...\n";

$request = new Request\ReprintLabelRequest();
$request
    ->setParcelNumber($parcelNumber)     // Required
    // These are the default values
    ->setLabelFormat(Model\Formats::A6)  // Required
    ->setReferenceAsBarcode(false)       // Required
    ->setFileType(Model\FileTypes::PDF)  // Required
    ->setDpi(Model\Dpi::DPI_203);        // Required (only used with ZPL / EPL formats)


try {
    $response = $api->reprintLabel($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Failed to reprint label: " . $e->getMessage();
    exit;
}

$fileName = $response->getName();
$fileContent = $response->getContent();
//$fileType = $response->getType();

$path = $labelsDir . DIRECTORY_SEPARATOR . $fileName;
file_put_contents($path, $fileContent);
echo "Label path : examples/labels/" . $fileName . "\n\n";

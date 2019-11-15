<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\Factory;
use Ekyna\Component\Dpd\Shipment\Model;
use Ekyna\Component\Dpd\Shipment\Request;


/* ---------------- Get the API ---------------- */

require __DIR__ . '/config.php';
$factory = new Factory($config);
$api = $factory->getShipmentApi();


/* ---------------- Return on demand ---------------- */

$parcelNumber = ""; // TODO Set the parcel number
if (empty($parcelNumber)) {
    throw new \Exception("Please set the parcel number.");
}

echo "Generating on demand return label...\n";

$request = new Request\ReturnOnDemandRequest();
$request
    ->setParcelNumber($parcelNumber)     // Required
    // These are the default values
    ->setLabelFormat(Model\Formats::A6)  // Required
    ->setReferenceAsBarcode(false)       // Required
    ->setFileType(Model\FileTypes::PDF)  // Required
    ->setDpi(Model\Dpi::DPI_203);        // Required (only used with ZPL / EPL formats)

try {
    $response = $api->returnOnDemand($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Failed to reprint label: " . $e->getMessage();
    exit;
}

$ids = $response->getParcels();

echo "Return id: {$response->getShpId()}\nParcels:\n";
foreach ($ids as $id) {
    echo " - $id\n";
}
echo "\n";

$fileName = $response->getLabel()->getName();
$fileContent = $response->getLabel()->getContent();
//$fileType = $response->getLabel()->getType();

$path = $labelsDir . DIRECTORY_SEPARATOR . $fileName;
file_put_contents($path, $fileContent);
echo "Label path : examples/labels/" . $fileName . "\n\n";

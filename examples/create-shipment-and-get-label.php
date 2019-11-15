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


/* ---------------- Create shipment ---------------- */

echo "Creating shipment...\n";

$receiver = new Model\Address();
$receiver
    // Firm OR (first AND last) names
    ->setName("Consignee Company Name")
    ->setFirstName("First Name")
    ->setLastName("Last Name")
    ->setHouseNumber("777")                           // Optional
    ->setStreet("Street name")                        // Required
    ->setStreetInfo("Additional street info")         // Optional
    ->setZipCode("13140")                             // Required
    ->setCity("MIRAMAS")                              // Required
    ->setCountryCode("FR")                            // Required
    ->setPhoneNumber("+33155443100")                  // Optional
    ->setMobileNumber("+33612345678")                 // Optional, Required for Predict
    ->setEmail("consignee@email.fr")                  // Optional
    ->setCode1("1234A")                               // Optional
    ->setCode2("5678B")                               // Optional
    ->setIntercom("Intercom")                         // Optional
    ->setAdditionalInfo("Delivery instructions");     // Optional

$parcel = new Model\Parcel();
$parcel
    ->setCref1("Reference 1")   // Required
    //->setCref2("Reference 2") // Optional
    //->setCref3("Reference 3") // Optional
    //->setCref4("Reference 4") // Optional
    ->setHinsAmount(666)        // Optional
    ->setWeight(2);             // Required

$request = new Request\ShipmentRequest();
$request
    ->setShipmentDate(new \DateTime("next monday"))  // Required
    ->setReceiver($receiver)                         // Required
    ->addParcel($parcel);                            // Required


//  ---- To use a relay point (PUDO Shop id) ----
//$request->setParcelShopId(pudoShopId);


//  ---- To replace the sender address ----
//$senderAddress = new Model\Address();
//$senderAddress
//    ->setName("senderAddress")
//    ->setBuildingNo("buildingNo")
//    ->setStreet("street")
//    ->setStreetInfo("streetInfo")
//    ->setZipCode("zipCode")
//    ->setCityName("cityName")
//    ->setCountryCode("countryCode")
//    ->setTelNo("telNo");
//$request
//    ->setReplaceSender(true)
//    ->setReplaceSenderAddress($senderAddress);


//  ---- To replace the return address ----
//$returnAddress = new Model\Address();
//$returnAddress
//    ->setName("returnAddress")
//    ->setBuildingNo("buildingNo")
//    ->setStreet("street")
//    ->setStreetInfo("streetInfo")
//    ->setZipCode("zipCode")
//    ->setCityName("cityName")
//    ->setCountryCode("countryCode")
//    ->setTelNo("telNo");
//$request
//    ->setSameReturnAddress(false)
//    ->setReturnAddress($returnAddress);

try {
    $response = $api->createShipment($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Failed to create shipment : " . $e->getMessage();
    exit;
}

$ids = $response->getTempShpId();

echo "Shipments temporary id :\n";
foreach ($ids as $id) {
    echo " - $id\n";
}
echo "\n";


/* ---------------- Get label ---------------- */

echo "Getting label...\n";

$request = new Request\GetLabelRequest();
$request
    ->setShpIdList($ids)                 // Required
    // These are the default values
    ->setLabelFormat(Model\Formats::A6)  // Required
    ->setReferenceAsBarcode(false)       // Required
    ->setFileType(Model\FileTypes::PDF)  // Required
    ->setDpi(Model\Dpi::DPI_203);        // Required (only used with ZPL / EPL formats)


try {
    $response = $api->getLabel($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Failed to create shipment : " . $e->getMessage();
    exit;
}

foreach ($response->getShipments() as $shipment) {
    echo sprintf(
        "Shipment %s:\n - parcels: %s:\n - return parcels: %s\n\n",
        $shipment->getShpId(),
        implode(', ', $shipment->getParcels()),             // Shipment tracking numbers
        implode(', ', $shipment->getReturnParcels() ?? [])  // Return tracking numbers
    );
}

$fileName = $response->getLabel()->getName();
$fileContent = $response->getLabel()->getContent();
//$fileType = $response->getType();

$path = $labelsDir . DIRECTORY_SEPARATOR . $fileName;
file_put_contents($path, $fileContent);
echo "Label path : examples/labels/" . $fileName . "\n\n";

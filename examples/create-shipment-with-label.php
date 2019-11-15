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


/* ---------------- Create shipment with label ---------------- */

echo "Creating shipment with label...\n";

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
    ->setCref2("Reference 2")   // Optional
    ->setCref3("Reference 3")   // Optional
    ->setCref4("Reference 4")   // Optional
    ->setHinsAmount(666)        // Optional
    ->setWeight(2);             // Required

$request = new Request\ShipmentWithLabelRequest();
$request
    ->setProduct(Model\Products::CLASSIC)
    ->setReturnType(Model\ReturnTypes::ON_DEMAND)
    ->setShipmentDate(new \DateTime("next monday"))  // Required
    ->setReceiver($receiver)                         // Required
    ->addParcel($parcel);                            // Required;


//  ----- To change the manifest ----
$request
    ->getManifest()
    // These are the default values
    ->setLabelFormat(Model\Formats::A6)  // Required
    ->setReferenceAsBarcode(false)       // Required
    ->setFileType(Model\FileTypes::PDF)  // Required
    ->setDpi(Model\Dpi::DPI_203);        // Required (only used with ZPL / EPL formats)


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
    $response = $api->createShipmentWithLabel($request);
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

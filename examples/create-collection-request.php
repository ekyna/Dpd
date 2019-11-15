<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\Factory;
use Ekyna\Component\Dpd\Shipment\Request;


/* ---------------- Get the API ---------------- */

require __DIR__ . '/config.php';
$factory = new Factory($config);
$api = $factory->getShipmentApi();


/* ---------------- Create shipment with label ---------------- */

echo "Creating collection request...\n";

$request = new Request\CreateCollectionRequest();
$request
    ->setWeight(2)
    ->setDesiredPickupDate($date = new \DateTime('next monday'));

$request
    ->getPickupAddress()
    ->setName("Company Name")
    ->setFirstName("First Name")
    ->setLastName("Last Name")
    ->setHouseNumber("777")
    ->setStreet("Street name")
    ->setStreetInfo("Additional street info")
    ->setZipCode("13140")
    ->setCity("MIRAMAS")
    ->setCountryCode("FR")
    ->setPhoneNumber("+33155443100")
    ->setMobileNumber("+33612345678")
    ->setEmail("consignee@email.fr")
    ->setCode1("1234A")
    ->setCode2("5678B")
    ->setIntercom("Intercom")
    ->setAdditionalInfo("Delivery instructions");

$request
    ->getDeliveryAddress()
    ->setName("Company Name")
    ->setFirstName("First Name")
    ->setLastName("Last Name")
    ->setStreet("Street name")
    ->setZipCode("13140")
    ->setCity("MIRAMAS")
    ->setCountryCode("FR")
    ->setPhoneNumber("+33155443100");

try {
    $response = $api->createCollectionRequest($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Failed to create collection request : " . $e->getMessage();
    exit;
}

echo "CallId: {$response->getCallId()}
Parcel number: {$response->getParcelNo()}
Created at : {$response->getCreatedAt()->format('Y-m-d H:i:s')}
";

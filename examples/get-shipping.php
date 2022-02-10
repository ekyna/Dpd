<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new EPrint\Api($ePrintConfig);

/* ---------------- Create request ---------------- */

$request = new EPrint\Request\GetShippingRequest();

$request->date = '31.01.2022';

$request->customer = new EPrint\Model\Customer();
$request->customer->number = $usePredict ? $predictNumber : $classicNumber;
$request->customer->countrycode = $countryCode;
$request->customer->centernumber = $centerNumber;

/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var \Ekyna\Component\Dpd\EPrint\Response\GetShippingResponse $response */
    $response = $api->GetShipping($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    if ($debug && $e instanceof Exception\ClientException) {
        echo "\nRequest:\n" . $e->request;
        echo "\nResponse:\n" . $e->response;
    }
    exit();
}
echo get_class($response) . "\n";

// Get result
$result = $response->GetShippingResult;
echo get_class($result) . "\n";

/** @var \Ekyna\Component\Dpd\EPrint\Model\Shipping $shipping */
foreach ($result->shippings->Shipping as $shipping) {
    $tracking = substr($shipping->shipment, 6);
    $reference = $shipping->reference;

    echo "$reference: $tracking\n";
}

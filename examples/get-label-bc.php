<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\EPrint;
use Ekyna\Component\Dpd\Exception;

/* ---------------- Client and API ---------------- */

$config = require __DIR__ . '/config.php';

$api = new EPrint\Api($config['eprint']);

// TODO Fill with a shipment number created by running create-shipment-with-labels-bc_*.php
$number = '10770400006243';

/* ---------------- Create request ---------------- */

// Shipment request

$customer = new EPrint\Model\Customer();
$customer->number = $config['customer_number'];
$customer->countrycode = $config['country_code'];
$customer->centernumber = $config['center_number'];

$labelType = new EPrint\Model\LabelType();
$labelType->type = EPrint\Enum\ELabelType::PNG;

$request = new EPrint\Request\ReceiveLabelBcRequest();
$request->customer = $customer;
$request->labelType = $labelType;
$request->shipmentNumber = $number;

/* ---------------- Get response ---------------- */

// Use API helper
try {
    $response = $api->GetLabelBc($request);
} catch (Exception\ExceptionInterface $exception) {
    dump_error($exception);
    throw $exception;
}

// Get result
$result = $response->GetLabelBcResult;

echo <<<EOF
BarCode: {$result->shipment->BarCode}
BarcodeSource: {$result->shipment->BarcodeSource}
BarcodeId: {$result->shipment->BarcodeId}

EOF;

dump_labels(pathinfo(__FILE__, PATHINFO_FILENAME), $labelType->type, $result->labels);

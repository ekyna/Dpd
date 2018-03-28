<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\EPrint;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new EPrint\Api($ePrintConfig);

/* ---------------- Create request ---------------- */

// Shipment request
$request = new EPrint\Request\ReceiveLabelRequest();

$request->parcelnumber = '801011158';
$request->countrycode = '250';
$request->centernumber = '35';

/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var \Ekyna\Component\Dpd\EPrint\Response\GetLabelResponse $response */
    $response = $api->GetLabel($request);
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
/** @var \Ekyna\Component\Dpd\EPrint\Model\LabelResponse $result */
$result = $response->GetLabelResult;
echo get_class($result) . "\n";

echo <<<EOF
Country code: {$result->countrycode}
Center number: {$result->centernumber}
Parcel number: {$result->parcelnumber}

EOF;


/** @var \Ekyna\Component\Dpd\EPrint\Model\Label $label */
$idx = 0;
foreach ($result->labels as $label) {
    echo "Label#$idx: " . strlen($label->label) . "\n";

    if (false === $im = imagecreatefromstring($label->label)) {
        throw new \Exception("Failed to retrieve the shipment label data.");
    }

    $filename = sprintf('%s_%s.png', 'reference', $idx);

    if (file_exists($filename)) unlink($filename);

    imagepng($im, $filename);
    imagedestroy($im);
}

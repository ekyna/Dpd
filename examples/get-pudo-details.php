<?php

require __DIR__ . '/../vendor/autoload.php';

use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\Pudo;

/* ---------------- Client and API ---------------- */

require __DIR__ . '/config.php';

$api = new Pudo\Api($pudoConfig);

/* ---------------- Create request ---------------- */

$request = new Pudo\Request\GetPudoDetailsRequest();

$request->pudo_id = 'P32805';


/* ---------------- Get response ---------------- */

// Use API helper
try {
    /** @var \Ekyna\Component\Dpd\Pudo\Response\GetPudoDetailsResponse $response */
    $response = $api->GetPudoDetails($request);
} catch (Exception\ExceptionInterface $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
echo get_class($response) . "\n";

var_dump($response);


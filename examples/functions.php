<?php

declare(strict_types=1);

use Ekyna\Component\Dpd\EPrint;
use Ekyna\Component\Dpd\EPrint\Model\Label;
use Ekyna\Component\Dpd\Exception\ClientException;

/**
 * @param string          $directory
 * @param string          $type
 * @param iterable<Label> $labels
 * @return void
 * @throws Exception
 */
function dump_labels(string $directory, string $type, iterable $labels): void
{
    $directory = __DIR__ . DIRECTORY_SEPARATOR . 'labels' . DIRECTORY_SEPARATOR . $directory;
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    $idx = 0;
    foreach ($labels as $label) {
        echo "Label#$idx: " . strlen($label->label) . ' (' . $label->type . ")\n";

        $extension = match ($type) {
            EPrint\Enum\ELabelType::PNG        => 'png',
            EPrint\Enum\ELabelType::PDF,
            EPrint\Enum\ELabelType::PDF_A6     => 'pdf',
            EPrint\Enum\ELabelType::ZPL,
            EPrint\Enum\ELabelType::ZPL_A6,
            EPrint\Enum\ELabelType::ZPL300,
            EPrint\Enum\ELabelType::ZPL300_A6, => 'zpl',
            EPrint\Enum\ELabelType::EPL        => 'epl',
        };

        $filename = $directory . DIRECTORY_SEPARATOR . sprintf('%s_%s.%s', 'reference', $idx, $extension);

        if (file_exists($filename)) {
            unlink($filename);
        }

        if ($type === EPrint\Enum\ELabelType::PNG) {
            if (false === $im = imagecreatefromstring($label->label)) {
                throw new Exception('Failed to retrieve the shipment label data.');
            }

            imagepng($im, $filename);
            imagedestroy($im);
        } else {
            file_put_contents($filename, $label->label);
        }
    }
}

function dump_error(Exception $exception): void
{
    global $debug;

    if (!$debug) {
        return;
    }

    echo "Error: {$exception->getMessage()}\n";

    if ($exception instanceof ClientException) {
        echo "Request:\n$exception->request\n";
        echo "Response:\n$exception->response\n";
    }
}

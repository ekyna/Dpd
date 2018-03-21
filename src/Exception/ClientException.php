<?php

namespace Ekyna\Component\Dpd\Exception;

/**
 * Class ClientException
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ClientException extends \RuntimeException implements ExceptionInterface
{
    /**
     * @var string
     */
    public $request;

    /**
     * @var string
     */
    public $response;


    /**
     * Pretty print the given XML.
     *
     * @param string $xml
     *
     * @return string
     */
    static function formatXml($xml)
    {
        if (empty($xml)) {
            return null;
        }

        $doc = new \DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xml);

        return $doc->saveXML();
    }
}

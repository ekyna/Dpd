<?php

namespace Ekyna\Component\Dpd\Exception;

/**
 * Class ClientException
 * @package Ekyna\Component\Dpd\Exception
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class ClientException extends \RuntimeException implements ExceptionInterface
{
    /**
     * Creates a new client exception.
     *
     * @param \SoapClient $client
     * @param \Exception  $exception
     *
     * @return ClientException
     */
    static function create(\SoapClient $client, \Exception $exception)
    {
        $message = $exception->getMessage() . "\n\n" .
            "Request: " . static::formatXml($client->__getLastRequest()) . "\n\n" .
            "Response: " . static::formatXml($client->__getLastResponse());

        return new static($message, $exception->getCode(), $exception);
    }

    /**
     * Pretty print the given XML.
     *
     * @param string $xml
     *
     * @return string
     */
    static function formatXml($xml)
    {
        $doc = new \DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->loadXML($xml);

        return $doc->saveXML();
    }
}

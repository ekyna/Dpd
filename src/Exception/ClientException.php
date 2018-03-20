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
     * @var string
     */
    public $request;

    /**
     * @var string
     */
    public $response;


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
        $exception = new static($exception->getMessage(), $exception->getCode(), $exception);

        $exception->request = static::formatXml($client->__getLastRequest());
        $exception->response = static::formatXml($client->__getLastResponse());

        return $exception;
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

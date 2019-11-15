<?php

namespace Ekyna\Component\Dpd\Relay;

use Ekyna\Component\Dpd\Exception\ClientException;
use GuzzleHttp as Http;

/**
 * Class Client
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Client
{
    private const ENDPOINT = 'http://mypudo.pickup-services.com/mypudo/mypudo.asmx/';

    /**
     * @var string
     */
    protected $carrier;

    /**
     * @var string
     */
    protected $key;

    /**
     * @var Http\Client
     */
    private $http;


    /**
     * Constructor.
     *
     * @param string $carrier
     * @param string $key
     */
    public function __construct(string $carrier, string $key)
    {
        $this->carrier = $carrier;
        $this->key = $key;

        $this->http = new Http\Client();
    }

    /**
     * Performs HTTP request.
     *
     * @param string $path
     * @param array  $data
     *
     * @return string The response body
     */
    public function call(string $path, array $data): string
    {
        $data = array_replace([
            'carrier' => $this->carrier,
            'key'     => $this->key,
        ], $data);

        try {
            $response = $this->http->get(self::ENDPOINT . $path, [
                'query' => $data,
            ]);
        } catch (Http\Exception\ClientException $e) {
            return $this->handleResponse($e->getResponse()->getBody()->getContents());
        }

        return $this->handleResponse($response->getBody()->getContents());
    }

    /**
     * Handles the response.
     *
     * @param string $body
     *
     * @return string
     */
    private function handleResponse(string $body): string
    {
        if (empty($body)) {
            throw new ClientException("Empty server response");
        }

        return $body;
    }
}
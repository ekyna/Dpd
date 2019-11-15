<?php

namespace Ekyna\Component\Dpd\Shipment;

use Ekyna\Component\Dpd\Exception\ClientException;
use GuzzleHttp as Http;

/**
 * Class Client
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Client
{
    private const ENDPOINT = 'https://ws.dpd.fr/backend/api/integration/public/';

    /**
     * @var string
     */
    protected $login;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var Http\Client
     */
    private $http;


    /**
     * Constructor.
     *
     * @param string $login
     * @param string $password
     */
    public function __construct(string $login, string $password)
    {
        $this->login = $login;
        $this->password = $password;

        $this->http = new Http\Client();
    }

    /**
     * Performs HTTP request.
     *
     * @param string $path
     * @param string $body
     *
     * @return array The response data
     */
    public function call(string $path, string $body): array
    {
        $request = new Http\Psr7\Request('POST', self::ENDPOINT . $path, [
            'Authorization' => 'Basic ' . base64_encode($this->login . ':' . $this->password),
            'Content-Type'  => 'application/json; charset=UTF-8',
        ], $body);

        try {
            $response = $this->http->send($request);
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
     * @return array
     */
    private function handleResponse(string $body): array
    {
        if (empty($body)) {
            throw new ClientException("Empty server response");
        }

        $data = json_decode($body, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ClientException("Failed to parse server response");
        }

        if (isset($data['httpStatus']) && 200 !== $data['httpStatus']) {
            if (isset($data['message'])) {
                throw new ClientException($data['message']);
            }

            throw new ClientException("Request failed without error message.");
        }

        return $data;
    }
}

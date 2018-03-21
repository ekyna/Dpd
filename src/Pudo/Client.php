<?php

namespace Ekyna\Component\Dpd\Pudo;

use Ekyna\Component\Dpd\Exception\ClientException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;

/**
 * Class Client
 * @package Ekyna\Component\Dpd\Pudo
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Client extends HttpClient
{
    const ENDPOINT = 'http://mypudo.pickup-services.com/mypudo/mypudo.asmx/';

    /**
     * @var string
     */
    private $carrier;

    /**
     * @var string
     */
    private $key;

    /**
     * @var bool
     */
    private $debug;


    /**
     * Constructor.
     *
     * @param string $carrier
     * @param string $key
     * @param bool   $cache
     * @param bool   $debug
     */
    public function __construct(string $carrier, string $key, bool $cache = false, bool $debug = false)
    {
        $this->carrier = $carrier;
        $this->key = $key;
        $this->debug = $debug;

        parent::__construct([
            'base_uri'        => static::ENDPOINT,
            'timeout'         => 30,
            'allow_redirects' => false,
        ]);
    }

    /**
     * Returns the carrier.
     *
     * @return string
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Returns the key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Performs the http call.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return Response
     * @throws ClientException
     */
    public function call(string $method, array $arguments): Response
    {
        try {
            return $this->request('GET', $method, [
                'query' => $arguments
            ]);
        } catch (\Exception $e) {
            throw new ClientException($e->getMessage(), $e->getCode(), $e);
        }
    }
}

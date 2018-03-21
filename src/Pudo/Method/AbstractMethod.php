<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Pudo\Method;

use Ekyna\Component\Dpd\Pudo\Client;
use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\InputInterface;
use Ekyna\Component\Dpd\MethodInterface;
use Ekyna\Component\Dpd\RequestInterface;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class AbstractMethod
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractMethod implements MethodInterface
{
    /**
     * @var Client
     */
    private $client;


    /**
     * Constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * @param RequestInterface $request
     *
     * @return \Ekyna\Component\Dpd\ResponseInterface
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $this->supports($request);

        if ($request instanceof InputInterface) {
            $request->validate();
        }

        $client = $this->getClient();

        $data = array_replace($request->toArray(), [
            'carrier' => $client->getCarrier(),
            'key'     => $client->getKey(),
        ]);

        $response = $client->call($this->getMethodName(), $data);

        return $this->parseResponse($response->getBody()->getContents());
    }

    /**
     * @inheritdoc
     */
    public function supports(RequestInterface $request): void
    {
        $class = $this->getRequestClass();

        if (!$request instanceof $class) {
            throw new Exception\InvalidArgumentException("Expected instance if $class.");
        }
    }

    /**
     * Returns the soap method name.
     *
     * @return string
     */
    abstract protected function getMethodName(): string;

    /**
     * Returns the supported request class.
     *
     * @return string
     */
    abstract protected function getRequestClass(): string;

    /**
     * Parse the response.
     *
     * @param string $xml
     *
     * @return ResponseInterface
     */
    abstract protected function parseResponse(string $xml): ResponseInterface;
}

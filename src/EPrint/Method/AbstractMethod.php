<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint\Method;

use Ekyna\Component\Dpd\EPrint\Client;
use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\InputInterface;
use Ekyna\Component\Dpd\MethodInterface;
use Ekyna\Component\Dpd\OutputInterface;
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
     * @inheritdoc
     */
    public function execute(RequestInterface $request): ResponseInterface
    {
        $this->supports($request);

        if ($request instanceof InputInterface) {
            $request->validate();
        }

        $data = new \SoapParam(['request' => $request], $this->getMethodName());

        $response = $this->getClient()->call($this->getMethodName(), [$data]);

        if ($response instanceof OutputInterface) {
            $response->initialize();
        }

        return $response;
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
}

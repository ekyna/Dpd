<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Client;
use Ekyna\Component\Dpd\Exception;
use Ekyna\Component\Dpd\Model;
use Ekyna\Component\Dpd\Request;

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
     * @param Request\RequestInterface $request
     *
     * @return \Ekyna\Component\Dpd\Response\ResponseInterface
     */
    public function execute(Request\RequestInterface $request)
    {
        $this->supports($request);

        if ($request instanceof Model\InputInterface) {
            $request->validate();
        }

        $data = new \SoapParam(['request' => $request], $this->getMethodName());

        $response = $this->getClient()->call($this->getMethodName(), [$data]);

        if ($response instanceof Model\OutputInterface) {
            $response->initialize();
        }

        return $response;
    }

    /**
     * @inheritdoc
     */
    public function supports(Request\RequestInterface $request)
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
    abstract protected function getMethodName();

    /**
     * Returns the supported request class.
     *
     * @return string
     */
    abstract protected function getRequestClass();
}

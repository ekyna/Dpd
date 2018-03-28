<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Pudo;

use Ekyna\Component\Dpd\Exception\RuntimeException;
use Ekyna\Component\Dpd\MethodInterface;

/**
 * Class Api
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @method Response\GetPudoListResponse GetPudoList(Request\GetPudoListRequest $request)
 * @method Response\GetPudoDetailsResponse GetPudoDetails(Request\GetPudoDetailsRequest $request)
 */
class Api
{
    /**
     * @var array
     */
    private $config;

    /**
     * @var Client
     */
    private $client;


    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = array_replace_recursive([
            'carrier' => 'EXA',
            'key'     => 'deecd7bc81b71fcc0e292b53e826c48f',
            'cache'    => true,
            'debug'    => false,
        ], $config);
    }

    /**
     * Calls the method with parameters.
     *
     * @param string $name       The method name
     * @param array  $parameters The parameters
     *
     * @return mixed
     */
    public function __call($name, $parameters)
    {
        $method = $this->createMethod($name);

        /* TODO if ($instance instanceof Cacheable) {
            return $instance->cache($parameters);
        }*/

        return $method->execute(current($parameters));
    }

    /**
     * Creates the method.
     *
     * @param string $name
     *
     * @return MethodInterface
     */
    private function createMethod(string $name): MethodInterface
    {
        $class = 'Ekyna\\Component\\Dpd\\Pudo\\Method\\' . ucwords($name);
        if (class_exists($class)) {
            /** @var MethodInterface $instance */
            return new $class($this->getClient());
        }

        throw new RuntimeException("Method {$name} does not exist");
    }

    /**
     * Returns the client.
     *
     * @return Client
     */
    private function getClient(): Client
    {
        if (null !== $this->client) {
            return $this->client;
        }

        return $this->client = new Client(
            $this->config['carrier'],
            $this->config['key'],
            $this->config['cache'],
            $this->config['debug']
        );
    }
}
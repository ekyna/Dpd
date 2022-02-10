<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint;

use Ekyna\Component\Dpd\Exception\RuntimeException;
use Ekyna\Component\Dpd\MethodInterface;

/**
 * Class Api
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @method Response\CreateShipmentResponse CreateShipment(Request\StdShipmentRequest $request)
 * @method Response\CreateShipmentWithLabelsResponse CreateShipmentWithLabels(Request\StdShipmentLabelRequest $request)
 * @method Response\CreateMultiShipmentResponse CreateMultiShipment(Request\MultiShipmentRequest $request)
 * @method Response\CreateReverseInverseShipmentResponse CreateReverseInverseShipment(Request\ReverseShipmentRequest $request)
 * @method Response\CreateReverseInverseShipmentWithLabelsResponse CreateReverseInverseShipmentWithLabels(Request\ReverseShipmentLabelRequest $request)
 * @method Response\CreateCollectionRequestResponse CreateCollectionRequest(Request\CollectionRequestRequest $request)
 * @method Response\TerminateCollectionRequestResponse TerminateCollectionRequest(Request\TerminateCollectionRequestRequest $request)
 * @method Response\GetShipmentResponse GetShipment(Request\ShipmentRequest $request)
 * @method Response\GetLabelResponse GetLabel(Request\ReceiveLabelRequest $request)
 * @method Response\GetShippingResponse GetShipping(Request\GetShippingRequest $request)
 */
class Api
{
    const TRACKING_URL = 'http://www.dpd.fr/traces_%s';

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
            'login'     => null,
            'password'  => null,
            'cache'     => true,
            'debug'     => false,
            'test'      => false,
            'ssl_check' => true,
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
        $class = 'Ekyna\\Component\\Dpd\\EPrint\\Method\\' . ucwords($name);
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
            $this->config['login'],
            $this->config['password'],
            $this->config['cache'],
            $this->config['debug'],
            $this->config['test'],
            $this->config['ssl_check']
        );
    }
}

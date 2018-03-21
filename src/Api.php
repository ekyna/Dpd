<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd;

use Ekyna\Component\Dpd\Exception\RuntimeException;
use Ekyna\Component\Dpd\Method\MethodInterface;
use Ekyna\Component\Dpd\Request;
use Ekyna\Component\Dpd\Response;

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
 * @method Response\GetShipmentResponse GetShipment(Request\ShipmentRequest $request)
 * @method Response\GetLabelResponse GetLabel(Request\ReceiveLabelRequest $request)
 */
class Api
{
    const TRACKING_URL = 'http://www.dpd.fr/traces_%s';

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
     * @param string $method
     *
     * @param array  $parameters
     *
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        if (!class_exists($class = $this->getClassNameFromMethod($method))) {
            throw new RuntimeException("Method {$method} does not exist");
        }

        /** @var MethodInterface $instance */
        $instance = new $class($this->client);

        /* TODO if ($instance instanceof Cacheable) {
            return $instance->cache($parameters);
        }*/

        return $instance->execute(current($parameters));
    }

    /**
     * Get class name that handles execution of this method
     *
     * @param string $method
     *
     * @return string
     */
    private function getClassNameFromMethod($method)
    {
        return 'Ekyna\\Component\\Dpd\\Method\\' . ucwords($method);
    }

    public function isAlive()
    {
        return $this->client->__soapCall('isAlive', []);
    }

    public function getInfo()
    {
        return $this->client->call('getInfo', []);
    }
}

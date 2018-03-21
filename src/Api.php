<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd;

use Ekyna\Component\Dpd\EPrint\Client as EPrintClient;
use Ekyna\Component\Dpd\EPrint\Request as EReq;
use Ekyna\Component\Dpd\EPrint\Response as ERes;
use Ekyna\Component\Dpd\Exception\RuntimeException;
use Ekyna\Component\Dpd\Pudo\Client as PudoClient;
use Ekyna\Component\Dpd\Pudo\Request as PReq;
use Ekyna\Component\Dpd\Pudo\Response as PRes;

/**
 * Class Api
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 *
 * @method ERes\CreateShipmentResponse CreateShipment(EReq\StdShipmentRequest $request)
 * @method ERes\CreateShipmentWithLabelsResponse CreateShipmentWithLabels(EReq\StdShipmentLabelRequest $request)
 * @method ERes\CreateMultiShipmentResponse CreateMultiShipment(EReq\MultiShipmentRequest $request)
 * @method ERes\CreateReverseInverseShipmentResponse CreateReverseInverseShipment(EReq\ReverseShipmentRequest $request)
 * @method ERes\CreateReverseInverseShipmentWithLabelsResponse CreateReverseInverseShipmentWithLabels(EReq\ReverseShipmentLabelRequest $request)
 * @method ERes\GetShipmentResponse GetShipment(EReq\ShipmentRequest $request)
 * @method ERes\GetLabelResponse GetLabel(EReq\ReceiveLabelRequest $request)
 *
 * @method PRes\GetPudoListResponse GetPudoList(PReq\GetPudoListRequest $request)
 * @method PRes\GetPudoDetailsResponse GetPudoDetails(PReq\GetPudoDetailsRequest $request)
 */
class Api
{
    const TRACKING_URL = 'http://www.dpd.fr/traces_%s';

    /**
     * @var array
     */
    private $config;

    /**
     * @var EPrintClient
     */
    private $ePrintClient;

    /**
     * @var PudoClient
     */
    private $pudoClient;


    /**
     * Constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = array_replace_recursive([
            'eprint' => [
                'login'    => null,
                'password' => null,
            ],
            'pudo'   => [
                'carrier' => 'EXA',
                'key'     => 'deecd7bc81b71fcc0e292b53e826c48f',
            ],
            'cache'  => true,
            'debug'  => false,
        ], $config);
    }

    /**
     * Calls the method with parameters.
     *
     * @param string $name The method name
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
            return new $class($this->getEPrintClient());
        }

        $class = 'Ekyna\\Component\\Dpd\\Pudo\\Method\\' . ucwords($name);
        if (class_exists($class)) {
            /** @var MethodInterface $instance */
            return new $class($this->getPudoClient());
        }

        throw new RuntimeException("Method {$name} does not exist");
    }

    /**
     * Returns the ePrint client.
     *
     * @return EPrintClient
     */
    private function getEPrintClient(): EPrintClient
    {
        if (null !== $this->ePrintClient) {
            return $this->ePrintClient;
        }

        return $this->ePrintClient = new EPrintClient(
            $this->config['eprint']['login'],
            $this->config['eprint']['password'],
            $this->config['cache'],
            $this->config['debug']
        );
    }

    /**
     * Returns the Pudo client.
     *
     * @return PudoClient
     */
    private function getPudoClient(): PudoClient
    {
        if (null !== $this->pudoClient) {
            return $this->pudoClient;
        }

        return $this->pudoClient = new PudoClient(
            $this->config['pudo']['carrier'],
            $this->config['pudo']['key'],
            $this->config['cache'],
            $this->config['debug']
        );
    }
}

<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd;

use Ekyna\Component\Dpd\Model;
use Ekyna\Component\Dpd\Request;
use Ekyna\Component\Dpd\Response;

/**
 * Class Api
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Api
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
     * Cette méthode génère une nouvelle expédition.
     * Avec le service Retour en Relais Préparé et Demandé, 2 n° de colis seront produits (flux Aller et Retour).
     *
     * @param Request\StdShipmentRequest $request
     *
     * @return Model\Shipment[]
     */
    public function createShipment(Request\StdShipmentRequest $request): array
    {
        $request->validate();

        $data = new \SoapParam(['request' => $request], 'CreateShipment');

        return $this->client->call('CreateShipment', [$data]);
    }

    /**
     * Cette méthode génère une nouvelle expédition et retourne le/les étiquette(s) correspondante(s).
     *
     * @param Request\StdShipmentLabelRequest $request
     *
     * @return Response\CreateShipmentWithLabelsResponse
     */
    public function createShipmentWithLabel(Request\StdShipmentLabelRequest $request)
    {
        $request->validate();

        $data = new \SoapParam(['request' => $request], 'CreateShipmentWithLabels');

        return $this->client->call('CreateShipmentWithLabels', [$data]);
    }

    public function isAlive()
    {
        return $this->client->__soapCall('isAlive', []);
    }

    public function getInfo()
    {
        return $this->client->call('getInfo', []);
    }

    /**
     * Make it possible to debug the last request.
     *
     * @return array
     */
    public function debugLastSoapRequest(): array
    {
        return [
            'request'  => [
                'headers' => $this->client->__getLastRequestHeaders(),
                'body'    => $this->client->__getLastRequest(),
            ],
            'response' => [
                'headers' => $this->client->__getLastResponseHeaders(),
                'body'    => $this->client->__getLastResponse(),
            ],
        ];
    }
}

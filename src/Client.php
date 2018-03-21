<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd;

use Ekyna\Component\Dpd\Exception\ClientException;
use Ekyna\Component\Dpd\Model;
use Ekyna\Component\Dpd\Response\ResponseInterface;

/**
 * Class Client
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Client extends \Soapclient implements ClientInterface
{
    const NAMESPACE = 'http://www.cargonet.software';
    const WSDL      = 'https://e-station.cargonet.software/dpd-eprintwebservice/eprintwebservice.asmx?WSDL';

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $debug;

    /**
     * @var \SoapHeader
     */
    private $header;


    /**
     * Constructor.
     *
     * @param string $login
     * @param string $password
     * @param bool   $cache
     * @param bool   $debug
     */
    public function __construct(string $login, string $password, bool $cache = false, bool $debug = false)
    {
        $this->login = $login;
        $this->password = $password;
        $this->debug = $debug;

        parent::__construct(static::WSDL, [
            'cache_wsdl'   => $cache ? WSDL_CACHE_BOTH : WSDL_CACHE_NONE,
            'trace'        => $debug ? 1 : 0,
            'soap_version' => SOAP_1_2,
            'compression'  => true,
            'classmap'     => [
                'Address'                                        => Model\Address::class,
                'ArrayOfLabel'                                   => Model\ArrayOfLabel::class,
                'ArrayOfShipment'                                => Model\ArrayOfShipment::class,
                'Contact'                                        => Model\Contact::class,
                'Label'                                          => Model\Label::class,
                'LabelResponse'                                  => Model\LabelResponse::class,
                'MultiShipment'                                  => Model\MultiShipment::class,
                'Shipment'                                       => Model\Shipment::class,
                'ShipmentDataExtended'                           => Model\ShipmentDataExtended::class,
                'ShipmentWithLabels'                             => Model\ShipmentWithLabels::class,
                'ShipmentsWithLabels'                            => Model\ShipmentsWithLabels::class,
                'CreateShipmentResponse'                         => Response\CreateShipmentResponse::class,
                'CreateMultiShipmentResponse'                    => Response\CreateMultiShipmentResponse::class,
                'CreateShipmentWithLabelsResponse'               => Response\CreateShipmentWithLabelsResponse::class,
                'CreateReverseInverseShipmentResponse'           => Response\CreateReverseInverseShipmentResponse::class,
                'CreateReverseInverseShipmentWithLabelsResponse' => Response\CreateReverseInverseShipmentWithLabelsResponse::class,
                'GetLabelResponse'                               => Response\GetLabelResponse::class,
                'GetShipmentResponse'                            => Response\GetShipmentResponse::class,
            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function call(string $method, array $arguments): ResponseInterface
    {
        try {
            return $this->__soapCall($method, $arguments, null, $this->getHeader());
        } catch (\Exception $exception) {
            if ($this->debug) {
                throw ClientException::create($this, $exception);
            }

            throw new ClientException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Returns the header.
     *
     * @return \SoapHeader
     */
    protected function getHeader(): \SoapHeader
    {
        if ($this->header) {
            return $this->header;
        }

        return $this->header = new \SoapHeader(static::NAMESPACE, 'UserCredentials', [
            'userid'   => $this->login,
            'password' => $this->password,
        ]);
    }
}

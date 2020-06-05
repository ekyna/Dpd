<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint;

use Ekyna\Component\Dpd\Exception\ClientException;
use Ekyna\Component\Dpd\ResponseInterface;

/**
 * Class Client
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Client extends \Soapclient
{
    const NAMESPACE = 'http://www.cargonet.software';

    const PROD_WSDL = 'https://e-station.cargonet.software/dpd-eprintwebservice/eprintwebservice.asmx?WSDL';
    const TEST_WSDL = 'http://92.103.148.116/exa-eprintwebservice/eprintwebservice.asmx?WSDL';

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
     * @param bool   $test
     * @param bool   $sslCheck
     */
    public function __construct(
        string $login,
        string $password,
        bool $cache = false,
        bool $debug = false,
        bool $test = false,
        bool $sslCheck = true
    ) {
        $this->login    = $login;
        $this->password = $password;
        $this->debug    = $debug;

        $options = [
            'cache_wsdl'     => $cache ? WSDL_CACHE_BOTH : WSDL_CACHE_NONE,
            'trace'          => $debug ? 1 : 0,
            'soap_version'   => SOAP_1_2,
            'compression'    => true,
            'classmap'       => [
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
                'CreateCollectionRequestResponse'                => Response\CreateCollectionRequestResponse::class,
                'TerminateCollectionRequestResponse'             => Response\TerminateCollectionRequestResponse::class,
                'GetLabelResponse'                               => Response\GetLabelResponse::class,
                'GetShipmentResponse'                            => Response\GetShipmentResponse::class,
            ],
        ];

        if (!$sslCheck) {
            $options['stream_context'] = stream_context_create([
                'ssl' => [
                    'verify_peer'       => false,
                    'verify_peer_name'  => false,
                    'allow_self_signed' => true,
                ],
            ]);
        }

        parent::__construct($test ? static::TEST_WSDL : static::PROD_WSDL, $options);
    }

    /**
     * Performs the soap call.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return ResponseInterface
     * @throws ClientException
     */
    public function call(string $method, array $arguments): ResponseInterface
    {
        try {
            return $this->__soapCall($method, $arguments, null, $this->getHeader());
        } catch (\Exception $e) {
            $exception = new ClientException($e->getMessage(), $e->getCode(), $e);

            if ($this->debug) {
                $exception->request  = ClientException::formatXml($this->__getLastRequest());
                $exception->response = ClientException::formatXml($this->__getLastResponse());
            }

            throw $exception;
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

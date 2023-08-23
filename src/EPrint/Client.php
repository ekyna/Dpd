<?php

declare (strict_types=1);

namespace Ekyna\Component\Dpd\EPrint;

use Ekyna\Component\Dpd\Exception\ClientException;
use Ekyna\Component\Dpd\ResponseInterface;
use Exception;
use SoapClient;
use SoapHeader;

/**
 * Class Client
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Client extends SoapClient
{
    private const NAMESPACE = 'http://www.cargonet.software';

    private const PROD_WSDL = 'https://e-station.cargonet.software/dpd-eprintwebservice/eprintwebservice.asmx?WSDL';
    private const TEST_WSDL = 'https://e-station-testenv.cargonet.software/eprintwebservice/eprintwebservice.asmx?WSDL';

    private string      $login;
    private string      $password;
    private bool        $debug;
    private ?SoapHeader $header = null;


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
        bool   $cache = false,
        bool   $debug = false,
        bool   $test = false,
        bool   $sslCheck = true
    ) {
        $this->login = $login;
        $this->password = $password;
        $this->debug = $debug;

        $options = [
            'cache_wsdl'   => $cache ? WSDL_CACHE_BOTH : WSDL_CACHE_NONE,
            'trace'        => $debug ? 1 : 0,
            'soap_version' => SOAP_1_2,
            'compression'  => true,
            'classmap'     => [
                'Address'                                          => Model\Address::class,
                'ArrayOfLabel'                                     => Model\ArrayOfLabel::class,
                'ArrayOfServiceEntry'                              => Model\ArrayOfServiceEntry::class,
                'ArrayOfShipment'                                  => Model\ArrayOfShipment::class,
                'ArrayOfShipmentBc'                                => Model\ArrayOfShipmentBc::class,
                'BcDataExt'                                        => Model\BcDataExt::class,
                'Contact'                                          => Model\Contact::class,
                'Label'                                            => Model\Label::class,
                'LabelBcResponse'                                  => Model\LabelBcResponse::class,
                'LabelResponse'                                    => Model\LabelResponse::class,
                'MultiShipment'                                    => Model\MultiShipment::class,
                'MultiShipmentBc'                                  => Model\MultiShipmentBc::class,
                'Sameday'                                          => Model\Sameday::class,
                'ServiceEntry'                                     => Model\ServiceEntry::class,
                'Shipment'                                         => Model\Shipment::class,
                'ShipmentBc'                                       => Model\ShipmentBc::class,
                'ShipmentDataExtended'                             => Model\ShipmentDataExtended::class,
                'ShipmentDataExtendedBc'                           => Model\ShipmentDataExtendedBc::class,
                'ShipmentWithLabels'                               => Model\ShipmentWithLabels::class,
                'ShipmentWithLabelsBc'                             => Model\ShipmentWithLabelsBc::class,
                'ShipmentsWithLabels'                              => Model\ShipmentsWithLabels::class,
                'ShipmentsWithLabelsBc'                            => Model\ShipmentsWithLabelsBc::class,
                'Shipping'                                         => Model\Shipping::class,
                'CreateShipmentResponse'                           => Response\CreateShipmentResponse::class,
                'CreateMultiShipmentResponse'                      => Response\CreateMultiShipmentResponse::class,
                'CreateMultiShipmentBcResponse'                    => Response\CreateMultiShipmentBcResponse::class,
                'CreateShipmentWithLabelsResponse'                 => Response\CreateShipmentWithLabelsResponse::class,
                'CreateShipmentWithLabelsBcResponse'               => Response\CreateShipmentWithLabelsBcResponse::class,
                'CreateReverseInverseShipmentResponse'             => Response\CreateReverseInverseShipmentResponse::class,
                'CreateReverseInverseShipmentBcResponse'           => Response\CreateReverseInverseShipmentBcResponse::class,
                'CreateReverseInverseShipmentWithLabelsResponse'   => Response\CreateReverseInverseShipmentWithLabelsResponse::class,
                'CreateReverseInverseShipmentWithLabelsBcResponse' => Response\CreateReverseInverseShipmentWithLabelsBcResponse::class,
                'CreateCollectionRequestResponse'                  => Response\CreateCollectionRequestResponse::class,
                'CreateCollectionRequestBcResponse'                => Response\CreateCollectionRequestBcResponse::class,
                'TerminateCollectionRequestResponse'               => Response\TerminateCollectionRequestResponse::class,
                'TerminateCollectionRequestBcResponse'             => Response\TerminateCollectionRequestBcResponse::class,
                'GetLabelResponse'                                 => Response\GetLabelResponse::class,
                'GetLabelBcResponse'                               => Response\GetLabelBcResponse::class,
                'GetShipmentResponse'                              => Response\GetShipmentResponse::class,
                'GetShipmentBcResponse'                            => Response\GetShipmentBcResponse::class,
                'GetShippingResponse'                              => Response\GetShippingResponse::class,
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
        } catch (Exception $e) {
            $exception = new ClientException($e->getMessage(), $e->getCode(), $e);

            if ($this->debug) {
                $exception->request = ClientException::formatXml($this->__getLastRequest());
                $exception->response = ClientException::formatXml($this->__getLastResponse());
            }

            throw $exception;
        }
    }

    /**
     * Returns the header.
     *
     * @return SoapHeader
     */
    protected function getHeader(): SoapHeader
    {
        if ($this->header) {
            return $this->header;
        }

        return $this->header = new SoapHeader(static::NAMESPACE, 'UserCredentials', [
            'userid'   => $this->login,
            'password' => $this->password,
        ]);
    }
}

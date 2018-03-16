<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd;

use Ekyna\Component\Dpd\Exception\ClientException;

/**
 * Class Client
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
class Client extends \Soapclient
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
            'cache_wsdl' => $cache ? WSDL_CACHE_BOTH : WSDL_CACHE_NONE,
            'trace'      => $debug ? 1 : 0,
        ]);
    }

    /**
     * Call the web service method.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     */
    public function call(string $method, array $arguments)
    {
        try {
            return $this->__soapCall($method, $arguments, null, $this->getHeader());
        } catch (\Exception $exception) {
            if ($this->debug) {
                throw ClientException::create($this, $exception);
            }

            throw $exception;
        }
    }

    /**
     * Returns the header.
     *
     * @return \SoapHeader
     */
    protected function getHeader()
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

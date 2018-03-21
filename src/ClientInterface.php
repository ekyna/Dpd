<?php

namespace Ekyna\Component\Dpd;

use Ekyna\Component\Dpd\Response\ResponseInterface;

/**
 * Interface ClientInterface
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
interface ClientInterface
{
    /**
     * Calls the web service method.
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return ResponseInterface
     *
     * @throws \Ekyna\Component\Dpd\Exception\ClientException
     */
    public function call(string $method, array $arguments): ResponseInterface;
}

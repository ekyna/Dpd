<?php

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Request\RequestInterface;
use Ekyna\Component\Dpd\Response\ResponseInterface;

/**
 * Interface MethodInterface
 * @package Ekyna\Component\Dpd\Method
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
interface MethodInterface
{
    /**
     * Executes the method.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request);
}
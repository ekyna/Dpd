<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Request\RequestInterface;

/**
 * Interface MethodInterface
 * @package Ekyna\Component\Dpd
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
interface MethodInterface
{
    /**
     * Executes the request.
     *
     * @param RequestInterface $request
     */
    public function execute(RequestInterface $request);

    /**
     * Asserts that the request is supported.
     *
     * @param RequestInterface $request
     *
     * @throws \Ekyna\Component\Dpd\Exception\ExceptionInterface
     */
    public function supports(RequestInterface $request);
}

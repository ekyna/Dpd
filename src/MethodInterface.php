<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd;

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
     *
     * @return \Ekyna\Component\Dpd\ResponseInterface
     */
    public function execute(RequestInterface $request): ResponseInterface;

    /**
     * Asserts that the request is supported.
     *
     * @param RequestInterface $request
     *
     * @throws \Ekyna\Component\Dpd\Exception\ExceptionInterface
     */
    public function supports(RequestInterface $request): void;
}

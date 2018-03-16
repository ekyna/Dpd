<?php

namespace Ekyna\Component\Dpd\Method;

use Ekyna\Component\Dpd\Client;

/**
 * Class AbstractMethod
 * @package Ekyna\Component\Dpd\Method
 * @author  Etienne Dauvergne <contact@ekyna.com>
 */
abstract class AbstractMethod implements MethodInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}

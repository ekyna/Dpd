<?php

namespace Ekyna\Component\Dpd\Relay\Request;

/**
 * Class DetailRequest
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class DetailRequest implements RequestInterface
{
    /**
     * @var string
     */
    private $id;


    /**
     * Constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /**
     * Returns the id.
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}

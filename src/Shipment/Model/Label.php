<?php

namespace Ekyna\Component\Dpd\Shipment\Model;

/**
 * Class Label
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Label
{
    /** @var string */
    private $name;

    /** @var string */
    private $content;

    /** @var string */
    private $type;


    /**
     * Constructor.
     *
     * @param string $name
     * @param string $content
     * @param string $type
     */
    public function __construct(string $name, string $content, string $type)
    {
        $this->name = $name;
        $this->content = $content;
        $this->type = $type;
    }

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the content.
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Returns the type.
     *
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}

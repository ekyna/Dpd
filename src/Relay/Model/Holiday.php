<?php

namespace Ekyna\Component\Dpd\Relay\Model;

/**
 * Class Holiday
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class Holiday
{
    /**
     * @var string
     */
    private $fromDate;

    /**
     * @var string
     */
    private $toDate;


    /**
     * Constructor.
     *
     * @param string $fromDate
     * @param string $toDate
     */
    public function __construct(string $fromDate, string $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    /**
     * Returns the from date.
     *
     * @return string
     */
    public function getFromDate(): string
    {
        return $this->fromDate;
    }

    /**
     * Returns the to date.
     *
     * @return string
     */
    public function getToDate(): string
    {
        return $this->toDate;
    }
}

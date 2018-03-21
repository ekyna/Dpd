<?php
declare (strict_types=1);

namespace Ekyna\Component\Dpd\Pudo\Model;

/**
 * Class Holiday
 * @package Ekyna\Component\Dpd\Pudo\Model
 * @author  Etienne Dauvergne <contact@ekyna.com>
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
     * Returns the fromDate.
     *
     * @return string
     */
    public function getFromDate(): string
    {
        return $this->fromDate;
    }

    /**
     * Returns the toDate.
     *
     * @return string
     */
    public function getToDate(): string
    {
        return $this->toDate;
    }
}

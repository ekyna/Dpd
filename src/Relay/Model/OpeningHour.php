<?php

namespace Ekyna\Component\Dpd\Relay\Model;

/**
 * Class OpeningHour
 * @author Etienne Dauvergne <contact@ekyna.com>
 */
class OpeningHour
{
    /**
     * @var int
     */
    private $day;

    /**
     * @var string
     */
    private $fromTime;

    /**
     * @var string
     */
    private $toTime;


    /**
     * Constructor.
     *
     * @param int    $day
     * @param string $fromTime
     * @param string $toTime
     */
    public function __construct(int $day, string $fromTime, string $toTime)
    {
        $this->day = $day;
        $this->fromTime = $fromTime;
        $this->toTime = $toTime;
    }

    /**
     * Returns the day.
     *
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }

    /**
     * Returns the fromTime.
     *
     * @return string
     */
    public function getFromTime(): string
    {
        return $this->fromTime;
    }

    /**
     * Returns the toTime.
     *
     * @return string
     */
    public function getToTime(): string
    {
        return $this->toTime;
    }
}

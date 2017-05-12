<?php

namespace AppBundle\Entity;

use DateTime;

class WeekDay
{
    /**
     * @var DateTime
     */
    private $date;

    /**
     * @var boolean
     */
    private $past;

    /**
     * @var boolean
     */
    private $today;

    /**
     * @var boolean
     */
    private $future;

    /**
     * @param null|DateTime $date
     */
    public function __construct(DateTime $date = null)
    {
        if ($date === null) {
            $date = new DateTime();
        }

        $this->date = $date;

        $daystamp = intval(date('Ymd', $this->date->getTimestamp()));
        $daystampToday = intval(date('Ymd'));

        $this->past = $daystamp < $daystampToday;
        $this->today = $daystamp === $daystampToday;
        $this->future = $daystamp > $daystampToday;
    }

    /**
     * @return DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return bool
     */
    public function isPast()
    {
        return $this->past;
    }

    /**
     * @return bool
     */
    public function isToday()
    {
        return $this->today;
    }

    /**
     * @return bool
     */
    public function isFuture()
    {
        return $this->future;
    }

    /**
     * @return self
     */
    public function getTomorrow()
    {
        $tsNextWeek = strtotime('tomorrow', $this->date->getTimestamp());

        $dateNextWeek = new DateTime();
        $dateNextWeek->setTimestamp($tsNextWeek);

        return new self($dateNextWeek);
    }

    /**
     * @return self
     */
    public function getYesterday()
    {
        $tsNextWeek = strtotime('yesterday', $this->date->getTimestamp());

        $dateNextWeek = new DateTime();
        $dateNextWeek->setTimestamp($tsNextWeek);

        return new self($dateNextWeek);
    }
}

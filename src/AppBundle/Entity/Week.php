<?php

namespace AppBundle\Entity;

use DateTime;

class Week
{
    /**
     * @var DateTime
     */
    private $dateFrom;

    /**
     * @var DateTime
     */
    private $dateTo;

    /**
     * @var WeekDay[]
     */
    private $days;

    /**
     * @param null|DateTime $date
     */
    public function __construct(DateTime $date = null)
    {
        if ($date === null) {
            $date = new DateTime();
        }

        // Set week start
        $tsFrom = strtotime('monday this week', $date->getTimestamp());
        if ($tsFrom === false) {
            $this->dateFrom = null;
        } else {
            $this->dateFrom = new DateTime();
            $this->dateFrom->setTimestamp($tsFrom);
        }

        // Set week end
        $tsTo = strtotime('sunday this week', $date->getTimestamp());
        if ($tsTo === false) {
            $this->dateTo = null;
        } else {
            $this->dateTo = new DateTime();
            $this->dateTo->setTimestamp($tsTo);
        }

        // Set week days
        $this->days = [];
        $currentDay = new WeekDay($this->dateFrom);
        while ($currentDay->getDate()->getTimestamp() <= $this->dateTo->getTimestamp()) {
            $this->days[] = $currentDay;

            $currentDay = $currentDay->getTomorrow();
        }
    }

    /**
     * @return DateTime
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * @return DateTime
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * @return WeekDay[]
     */
    public function getDays()
    {
        return $this->days;
    }

    /**
     * @return self
     */
    public function getNextWeek()
    {
        $tsNextWeek = strtotime('monday next week', $this->dateFrom->getTimestamp());

        $dateNextWeek = new DateTime();
        $dateNextWeek->setTimestamp($tsNextWeek);

        return new self($dateNextWeek);
    }

    /**
     * @return self
     */
    public function getLastWeek()
    {
        $tsNextWeek = strtotime('monday last week', $this->dateFrom->getTimestamp());

        $dateNextWeek = new DateTime();
        $dateNextWeek->setTimestamp($tsNextWeek);

        return new self($dateNextWeek);
    }
}

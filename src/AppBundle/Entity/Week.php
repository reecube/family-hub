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
     * @var DateTime[]
     */
    private $cachedDays;

    /**
     * @param null|DateTime $date
     */
    public function __construct(DateTime $date = null)
    {
        if ($date === null) {
            $date = new DateTime();
        }

        $tsFrom = strtotime('monday this week', $date->getTimestamp());
        if ($tsFrom === false) {
            $this->dateFrom = null;
        } else {
            $this->dateFrom = new DateTime();
            $this->dateFrom->setTimestamp($tsFrom);
        }

        $tsTo = strtotime('sunday this week', $date->getTimestamp());
        if ($tsTo === false) {
            $this->dateTo = null;
        } else {
            $this->dateTo = new DateTime();
            $this->dateTo->setTimestamp($tsTo);
        }

        $this->cachedDays = null;
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
     * @return DateTime[]
     */
    public function getDays()
    {
        if ($this->cachedDays !== null) {
            return $this->cachedDays;
        }

        $days = [];

        $currentDate = $this->dateFrom;

        while ($currentDate->getTimestamp() <= $this->dateTo->getTimestamp()) {
            $days[] = $currentDate;

            $currentTimestamp = strtotime('tomorrow', $currentDate->getTimestamp());

            $currentDate = new DateTime();
            $currentDate->setTimestamp($currentTimestamp);
        }

        $this->cachedDays = $days;

        return $days;
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

<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="dinner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DinnerRepository")
 */
class Dinner
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var DinnerSubscription[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="DinnerSubscription", mappedBy="dinner")
     */
    private $dinnerSubscriptions;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dinnerSubscriptions = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \DateTime $date
     *
     * @return Dinner
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param integer $type
     * @return Dinner
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param DinnerSubscription $dinnerSubscription
     * @return Dinner
     */
    public function addDinnerSubscription(DinnerSubscription $dinnerSubscription)
    {
        $this->dinnerSubscriptions[] = $dinnerSubscription;

        return $this;
    }

    /**
     * @param DinnerSubscription $dinnerSubscription
     */
    public function removeDinnerSubscription(DinnerSubscription $dinnerSubscription)
    {
        $this->dinnerSubscriptions->removeElement($dinnerSubscription);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDinnerSubscriptions()
    {
        return $this->dinnerSubscriptions;
    }
}

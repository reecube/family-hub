<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="dinner_subscription")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DinnerSubscriptionRepository")
 */
class DinnerSubscription
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
     * @var boolean
     *
     * @ORM\Column(name="later", type="boolean")
     */
    private $later = false;

    /**
     * @var boolean
     *
     * @ORM\Column(name="earlier", type="boolean")
     */
    private $earlier = false;

    /**
     * @ORM\ManyToOne(targetEntity="Dinner", inversedBy="dinnerSubscriptions")
     * @ORM\JoinColumn(name="dinner_id", referencedColumnName="id")
     */
    private $dinner;

    /**
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="dinnerSubscriptions")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private $person;


    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param boolean $later
     * @return DinnerSubscription
     */
    public function setLater($later)
    {
        $this->later = $later;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getLater()
    {
        return $this->later;
    }

    /**
     * @param boolean $earlier
     * @return DinnerSubscription
     */
    public function setEarlier($earlier)
    {
        $this->earlier = $earlier;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getEarlier()
    {
        return $this->earlier;
    }

    /**
     * @param Dinner $dinner
     * @return DinnerSubscription
     */
    public function setDinner(Dinner $dinner = null)
    {
        $this->dinner = $dinner;

        return $this;
    }

    /**
     * @return Dinner
     */
    public function getDinner()
    {
        return $this->dinner;
    }

    /**
     * @param Person $person
     * @return DinnerSubscription
     */
    public function setPerson(Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }
}

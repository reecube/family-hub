<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="person")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonRepository")
 */
class Person
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
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=20, nullable=true)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=50)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=50, nullable=true)
     */
    private $lastname;

    /**
     * @var boolean
     *
     * @ORM\Column(name="female", type="boolean")
     */
    private $female;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allow_login", type="boolean")
     */
    private $allowLogin = false;

    /**
     * @var User
     *
     * @ORM\OneToOne(targetEntity="User", inversedBy="person")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    private $user;

    /**
     * @var Diet[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Diet", inversedBy="persons")
     * @ORM\JoinTable(name="person_diet",
     *      joinColumns={@ORM\JoinColumn(name="person_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="diet_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $diets;

    /**
     * @var DinnerSubscription[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="DinnerSubscription", mappedBy="person")
     */
    private $dinnerSubscriptions;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diets = new ArrayCollection();
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
     * @param string $nickname
     * @return Person
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param string $firstname
     * @return Person
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $lastname
     * @return Person
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param boolean $female
     * @return Person
     */
    public function setFemale($female)
    {
        $this->female = $female;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getFemale()
    {
        return $this->female;
    }

    /**
     * @param boolean $allowLogin
     * @return Person
     */
    public function setAllowLogin($allowLogin)
    {
        $this->allowLogin = $allowLogin;

        return $this;
    }

    /**
     * @return boolean
     */
    public function getAllowLogin()
    {
        return $this->allowLogin;
    }

    /**
     * @param User $user
     * @return Person
     */
    public function setUser(User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Diet $diet
     * @return Person
     */
    public function addDiet(Diet $diet)
    {
        $this->diets[] = $diet;

        return $this;
    }

    /**
     * @param Diet $diet
     */
    public function removeDiet(Diet $diet)
    {
        $this->diets->removeElement($diet);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDiets()
    {
        return $this->diets;
    }

    /**
     * @param DinnerSubscription $dinnerSubscription
     * @return Person
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

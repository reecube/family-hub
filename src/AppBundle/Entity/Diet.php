<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="diet")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DietRepository")
 */
class Diet
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var Person[]|\Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="diets")
     */
    private $persons;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->persons = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     * @return Diet
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $description
     * @return Diet
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param Person $person
     * @return Diet
     */
    public function addPerson(Person $person)
    {
        $this->persons[] = $person;

        return $this;
    }

    /**
     * @param Person $person
     */
    public function removePerson(Person $person)
    {
        $this->persons->removeElement($person);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersons()
    {
        return $this->persons;
    }
}

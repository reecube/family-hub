<?php

namespace AppBundle\Entity;

use AppBundle\Enum\Notificationlevel;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var Person
     *
     * @ORM\OneToOne(targetEntity="Person", mappedBy="user")
     */
    private $person;

    /**
     * @var int
     *
     * @ORM\Column(name="notification_level", type="integer")
     */
    private $notificationLevel = Notificationlevel::NONE;

    /**
     * @var string
     *
     * @ORM\Column(name="clipclip_key", type="string", length=10, nullable=true)
     */
    private $clipclipKey;


    /**
     * @param Person $person
     * @return User
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

    /**
     * Set notificationLevel
     *
     * @param integer $notificationLevel
     *
     * @return User
     */
    public function setNotificationLevel($notificationLevel)
    {
        $this->notificationLevel = $notificationLevel;

        return $this;
    }

    /**
     * Get notificationLevel
     *
     * @return integer
     */
    public function getNotificationLevel()
    {
        return $this->notificationLevel;
    }

    /**
     * @param string $clipclipKey
     * @return User
     */
    public function setClipclipKey($clipclipKey)
    {
        $this->clipclipKey = $clipclipKey;

        return $this;
    }

    /**
     * @return string
     */
    public function getClipclipKey()
    {
        return $this->clipclipKey;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="session")
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="city", length=255)
     *
     * @var string
     */
    private $city;

    /**
     * @ORM\Column(type="string", name="name", length=255)
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="datetime", name="open_date")
     *
     * @var \DateTime
     */
    private $openAt;

    /**
     * @ORM\Column(type="datetime", name="start_date")
     *
     * @var \DateTime
     */
    private $startAt;

    /**
     * @ORM\Column(type="integer", name="type")
     *
     * @var int
     */
    private $type;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="SessionUser", mappedBy="session")
     */
    protected $sessionUsers;

    public function __construct()
    {
        $this->sessionUsers = new ArrayCollection();
    }

    /**
     * @param string $city
     *
     * @return Session
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * get city.
     *
     * @return Session
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $name
     *
     * @return Address
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * get name.
     *
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of openAt.
     *
     * @param string $openAt
     *
     * @return Session
     */
    public function setOpenAt($openAt)
    {
        $this->openAt = $openAt;

        return $this;
    }

    /**
     * Get the value of openAt.
     *
     * @return string
     */
    public function getOpenAt()
    {
        return $this->openAt;
    }

    /**
     * Set the value of openAt.
     *
     * @param string $openAt
     *
     * @return Session
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get the value of startAt.
     *
     * @return string
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Add SessionUser.
     *
     * @param \AppBundle\Entity\SessionUser $sessionUser
     *
     * @return User
     */
    public function addSessionUser(\AppBundle\Entity\SessionUser $sessionUser)
    {
        $this->sessionUsers[] = $sessionUser;

        return $this;
    }

    /**
     * Remove sessionUser.
     *
     * @param \AppBundle\Entity\SessionUser $sessionUser
     */
    public function removeUserSession(\AppBundle\Entity\SessionUser $sessionUser)
    {
        $this->sessionUsers->removeElement($sessionUser);
    }

    /**
     * Get sessionUsers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSessionUsers()
    {
        return $this->sessionUsers;
    }

    /**
     * Set the value of type.
     *
     * @param int $type
     *
     * @return Session
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the value of type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }
}

<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SessionUserRepository")
 * @ORM\Table(name="session_user")
 */
class SessionUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Session", inversedBy="sessionUsers")
     * @ORM\JoinColumn(name="session_id", referencedColumnName="id")
     */
    protected $session = null;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="userSessions")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user = null;

    /**
     * @ORM\Column(type="string", name="code", length=255)
     *
     * @var string
     */
    private $code;

    /**
     * @ORM\Column(type="integer", name="status", length=1)
     *
     * @var int
     */
    private $status;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param int $id
     *
     * @return \AppBundle\Entity\Project
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set Sessions.
     *
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * get Session.
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Set User.
     *
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * get User.
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $code
     *
     * @return SessionUser
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * get code.
     *
     * @return code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $status
     *
     * @return SessionUser
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * get status.
     *
     * @return status
     */
    public function getStatus()
    {
        return $this->status;
    }
}

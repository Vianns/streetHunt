<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SessionUserRepository")
 * @ORM\Table(name="session_user")
 */
class SessionUser
{
    const STATUS_REGISTER = 0;
    const STATUS_VALIDATED = 1;
    const STATUS_KILLED = 2;

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
     * @ORM\Column(type="string", name="code", length=255, nullable=true)
     *
     * @var string
     */
    private $code;

    /**
     * @ORM\Column(type="string", name="target", length=255, nullable=true)
     *
     * @var string
     */
    private $target;

    /**
     * @ORM\Column(type="string", name="killed_by", length=255, nullable=true)
     *
     * @var string
     */
    private $killedBy;

    /**
     * @ORM\Column(type="integer", name="nb_kill", nullable=true)
     *
     * @var string
     */
    private $nbKill;

    /**
     * @ORM\Column(type="integer", name="status", length=1, nullable=true)
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
     * @return \AppBundle\Entity\SessionUser
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

        return $this;
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
     * @param string $target
     *
     * @return SessionUser
     */
    public function setTarget($target)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * get target.
     *
     * @return target
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param string $killedBy
     *
     * @return SessionUser
     */
    public function setKilledBy($killedBy)
    {
        $this->killedBy = $killedBy;

        return $this;
    }

    /**
     * get killedBy.
     *
     * @return killedBy
     */
    public function getKilledBy()
    {
        return $this->killedBy;
    }

    /**
     * Set the value of nb kill.
     *
     * @param int $nbKill
     *
     * @return \AppBundle\Entity\SessionUser
     */
    public function setNbKill($nbKill)
    {
        $this->nbKill = $nbKill;

        return $this;
    }

    /**
     * Get the value of nbKill.
     *
     * @return int
     */
    public function getNbKill()
    {
        return $this->nbKill;
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

    /**
     * get statuses.
     *
     * @return array statuses
     */
    public function getStatuses()
    {
        return [
            self::STATUS_REGISTER => $this->getStatusLabel(self::STATUS_REGISTER),
            self::STATUS_VALIDATED => $this->getStatusLabel(self::STATUS_VALIDATED),
        ];
    }

    /**
     * get statusLabel.
     *
     * @return status
     */
    public function getStatusLabel($status = null)
    {
        if (null === $status) {
            $status = $this->getStatus();
        }

        switch ($status) {
            case self::STATUS_REGISTER:
                $statusLabel = 'enregistré';
                break;

            case self::STATUS_VALIDATED:
                $statusLabel = 'validé';
                break;

            case self::STATUS_KILLED:
                $statusLabel = 'éliminé';
                break;

            default:
                $statusLabel = '??';
                break;
        }

        return $statusLabel;
    }
}

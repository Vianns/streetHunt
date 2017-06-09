<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;
use AppBundle\Entity\SessionUser;

/**
 * UserService.
 */
class SessionUserService extends BaseService
{
    protected $em;
    protected $repoSessionUser;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;

        $this->repoSessionUser = $em->getRepository('AppBundle:SessionUser');
    }

    /**
     * new user.
     *
     * @param User    $user
     * @param Session $session
     */
    public function newUser($user, $session)
    {
        $sessionUser = new SessionUser();
        $sessionUser->setUser($user);
        $sessionUser->setSession($session);
        $sessionUser->setStatus(SessionUser::STATUS_REGISTER);

        $this->persistAndFlush($user);
        $this->persistAndFlush($sessionUser);
    }

    /**
     * Retrieve rank label of given user.
     *
     * @param string $targetCode
     */
    public function killTarget($userSession, $targetCode)
    {
        $targetSessionUser = $this->repoSessionUser->findBySessionAndCode($userSession->getSession()->getId(), $targetCode);

        $userSession->setTarget($targetSessionUser->getTarget());
        $userSession->setNbKill($userSession->getNbKill() + 1);

        $targetSessionUser->setKilledBy($userSession->getCode());
        $targetSessionUser->setTarget(null);
        $targetSessionUser->setStatus(SessionUser::STATUS_KILLED);

        $this->persistAndFlush($userSession);
        $this->persistAndFlush($targetSessionUser);
    }
}

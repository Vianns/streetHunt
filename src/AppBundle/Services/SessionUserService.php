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
     * Retrieve rank label of given user.
     *
     * @param string $targetCode
     */
    public function killTarget($userSession, $targetCode)
    {
        $targetSessionUser = $this->repoSessionUser->findBySessionAndCode($userSession->getSession()->getId(), $targetCode);

        $userSession->setTarget($targetSessionUser->getTarget());
        $targetSessionUser->setKilledBy($userSession->getCode());
        $targetSessionUser->setTarget(null);
        $targetSessionUser->setStatus(SessionUser::STATUS_KILLED);
        $this->persistAndFlush($userSession);
        $this->persistAndFlush($targetSessionUser);
    }
}

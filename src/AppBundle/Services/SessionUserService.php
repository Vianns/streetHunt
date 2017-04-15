<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\User;

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
        $this->persistAndFlush($userSession);
    }
}

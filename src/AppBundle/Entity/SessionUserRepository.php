<?php

namespace AppBundle\Entity;

/**
 * SessionRepository.
 */
class SessionUserRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * find by and user.
     *
     * @param [type] $user [description]
     *
     * @return [type] [description]
     */
    public function findByAndUser($user)
    {
        $result = $this
            ->createQueryBuilder('su')
            ->andWhere('su.user = :user')
            ->setParameter('user', $user)
            ->setMaxResults(1)
            ->getQuery()->getResult();

        return 0 === count($result) ? null : $result[0];
    }

    /**
     * find by session and user.
     *
     * @param [type] $session [description]
     * @param [type] $user    [description]
     *
     * @return [type] [description]
     */
    public function findBySessionAndUser($session, $user)
    {
        $result = $this
            ->createQueryBuilder('su')
            ->andWhere('su.user = :user')
            ->andWhere('su.session = :session')
            ->setParameter('user', $user)
            ->setParameter('session', $session)
            ->setMaxResults(1)
            ->getQuery()->getResult();

        return 0 === count($result) ? null : $result[0];
    }

    /**
     * find target.
     *
     * @return string
     */
    public function findTarget($session, $id)
    {
        $result = $this
            ->createQueryBuilder('su')
            ->andWhere('su.id > :id')
            ->andWhere('su.session = :session')
            ->andWhere('su.status = :status')
            ->orderBy('su.id', 'ASC')
            ->setParameter('id', $id)
            ->setParameter('session', $session)
            ->setParameter('status', SessionUser::STATUS_VALIDATED)
            ->setMaxResults(1)
            ->getQuery()->getResult();

        if (0 === count($result)) {
            $result = $this
                ->createQueryBuilder('su')
                ->andWhere('su.id != :id')
                ->andWhere('su.session = :session')
                ->andWhere('su.status = :status')
                ->orderBy('su.id', 'ASC')
                ->setParameter('id', $id)
                ->setParameter('session', $session)
                ->setParameter('status', SessionUser::STATUS_VALIDATED)
                ->setMaxResults(1)
                ->getQuery()->getResult();
        }

        return 0 === count($result) ? null : $result[0]->getCode();
    }

    public function findBySessionAndCode($session, $code)
    {
        $result = $this
            ->createQueryBuilder('su')
            ->andWhere('su.session = :session')
            ->andWhere('su.code = :code')
            ->setParameter('code', $code)
            ->setParameter('session', $session)
            ->setMaxResults(1)
            ->getQuery()->getResult();

        return 0 === count($result) ? null : $result[0];
    }
}

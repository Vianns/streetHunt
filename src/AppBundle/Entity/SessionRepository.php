<?php

namespace AppBundle\Entity;

/**
 * SessionRepository.
 */
class SessionRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCurrent()
    {
        $dateNow = new \DateTime();

        return $this
            ->createQueryBuilder('s')
            ->andWhere('s.openAt <= :dateNow')
            ->andWhere('s.isOver = 0')
            ->orderBy('s.openAt', 'ASC')
            ->setParameter('dateNow', $dateNow)
            ->getQuery()->getResult();
    }

    /**
     * find by user.
     *
     * @param [type] $user [description]
     *
     * @return [type] [description]
     */
    public function findByUser($user)
    {
        $result = $this
            ->createQueryBuilder('s')
            ->innerJoin('s.sessionUsers', 'su')
            ->andWhere('su.user = :user')
            ->setParameter('user', $user)
            ->setMaxResults(1)
            ->getQuery()->getResult();

        return 0 === count($result) ? null : $result[0];
    }
}

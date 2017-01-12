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
}

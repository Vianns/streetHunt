<?php

namespace AppBundle\Services;

abstract class BaseService
{
    protected function persistAndFlush($entity)
    {
        $this->em->persist($entity);
        $this->em->flush();
    }

    /**
     * remove entity.
     *
     * @param Entity $entity
     */
    protected function remove($entity)
    {
        $this->em->remove($entity);
        $this->em->flush();
    }
}

<?php

namespace Cinema;

use Doctrine\ORM\EntityManager;

class SeatMapper
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findCinemaById($id)
    {
        return $this->getRepository()->findOneById($id);
    }

    protected function getRepository()
    {
        return $this->entityManager->getRepository('Cinema\Model\Cinema');
    }
}

<?php

namespace Cinema;

use Cinema\Model\Cinema;
use Doctrine\ORM\EntityRepository;
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

    /**
     * @param int $id
     * @return Cinema|null
     */
    public function findCinemaById($id)
    {
        return $this->getRepository()->findOneById($id);
    }

    /**
     * @return EntityRepository
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository('Cinema\Model\Cinema');
    }
}

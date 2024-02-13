<?php

namespace App\Infrastructure\Repository\TimeSpent;

use App\Domain\Entity\TimeSpent;
use App\Domain\Repository\TimeSpentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TimeSpentRepository extends ServiceEntityRepository implements TimeSpentRepositoryInterface
{

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, TimeSpent::class);
    }



    public function findOne(int $id): ?TimeSpent{
        return $this->find($id);
    }

    public function save(TimeSpent $timeSpent): void {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($timeSpent);
        $entityManager->flush();
    }

    public function remove(TimeSpent $timeSpent): void {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($timeSpent);
        $entityManager->flush();
    }

}


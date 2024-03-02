<?php

namespace App\Infrastructure\Repository\TimeSpent;

use App\Domain\Entity\Contractor;
use App\Domain\Entity\TimeSpent;
use App\Domain\Repository\TimeSpentRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
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

    public function getTimeSpent(int $page = 1, int $itemsPerPage = 30,?Contractor $contractor= null): DoctrinePaginator {
        $qb = $this->createQueryBuilder('ts');

        if(!empty($contractor)){
            $qb->where('ts.contractor = :contractor')->setParameter('contractor', $contractor);
        }

        $qb->addCriteria(
            Criteria::create()
                    ->setFirstResult(($page - 1) * $itemsPerPage)
                    ->setMaxResults($itemsPerPage)
            );


        return new DoctrinePaginator($qb);
    }
}


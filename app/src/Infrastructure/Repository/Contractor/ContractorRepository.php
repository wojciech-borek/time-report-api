<?php

namespace App\Infrastructure\Repository\Contractor;


use App\Domain\Entity\Contract;
use App\Domain\Entity\Contractor;
use App\Domain\Repository\ContractorRepositoryInterface;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

class ContractorRepository extends ServiceEntityRepository implements ContractorRepositoryInterface
{


    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, Contractor::class);
    }


    public function save(Contractor $contractor): void {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($contractor);
        $entityManager->flush();
    }

    public function getContractors(int $page = 1, int $itemsPerPage = 30): DoctrinePaginator {
        return new DoctrinePaginator(
            $this->createQueryBuilder('c')
                ->addCriteria(
                    Criteria::create()
                        ->setFirstResult(($page - 1) * $itemsPerPage)
                        ->setMaxResults($itemsPerPage)
                )
        );

    }

    public function findOne(int $id): ?Contractor{
        return $this->find($id);
    }

}


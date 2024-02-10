<?php


namespace App\Domain\Repository;


use App\Domain\Entity\Contractor;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

interface ContractorRepositoryInterface
{
    public function save(Contractor $contractor): void;
    public function getContractors(int $page = 1, int $itemsPerPage = 30): DoctrinePaginator;
    public function findOne(int $id): ?Contractor;

}
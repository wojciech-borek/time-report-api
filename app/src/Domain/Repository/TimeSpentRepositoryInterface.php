<?php


namespace App\Domain\Repository;


use App\Domain\Entity\Contractor;
use App\Domain\Entity\TimeSpent;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;

interface TimeSpentRepositoryInterface
{
    public function findOne(int $id): ?TimeSpent;
    public function save(TimeSpent $timeSpent): void;
    public function remove(TimeSpent $timeSpent): void;
    public function getTimeSpent(int $page = 1, int $itemsPerPage = 30,?Contractor $contractor= null): DoctrinePaginator;

}
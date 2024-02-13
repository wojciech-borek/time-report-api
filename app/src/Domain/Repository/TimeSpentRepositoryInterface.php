<?php


namespace App\Domain\Repository;


use App\Domain\Entity\TimeSpent;

interface TimeSpentRepositoryInterface
{
    public function findOne(int $id): ?TimeSpent;
    public function save(TimeSpent $timeSpent): void;
    public function remove(TimeSpent $timeSpent): void;

}
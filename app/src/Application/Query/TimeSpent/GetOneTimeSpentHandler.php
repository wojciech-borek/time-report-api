<?php


namespace App\Application\Query\TimeSpent;


use App\Domain\Entity\TimeSpent;
use App\Domain\Repository\TimeSpentRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetOneTimeSpentHandler
{
    public function __construct(private TimeSpentRepositoryInterface $repository) {
    }

    public function __invoke(GetOneTimeSpentQuery $query): ?TimeSpent {

        return $this->repository->findOne($query->getId());
    }
}
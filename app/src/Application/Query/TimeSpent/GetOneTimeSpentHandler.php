<?php


namespace App\Application\Query\TimeSpent;


use ApiPlatform\Exception\ItemNotFoundException;
use App\Domain\Entity\TimeSpent;
use App\Domain\Repository\TimeSpentRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetOneTimeSpentHandler
{
    public function __construct(private TimeSpentRepositoryInterface $repository) {
    }

    public function __invoke(GetOneTimeSpentQuery $query): TimeSpent {

        $timeSpent = $this->repository->findOne($query->getId());
        if (null === $timeSpent) {
            throw new ItemNotFoundException($query->getId());
        }
        return $timeSpent;
    }
}
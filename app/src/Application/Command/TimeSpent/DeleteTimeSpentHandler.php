<?php

namespace App\Application\Command\TimeSpent;

use App\Domain\Repository\TimeSpentRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class DeleteTimeSpentHandler
{

    public function __construct(private TimeSpentRepositoryInterface $repository) {
    }

    public function __invoke(DeleteTimeSpentCommand $command) {
        $entity =$this->repository->findOne($command->getId());
        if (null === $entity) {
            return;
        }
        $this->repository->remove($entity);
    }

}

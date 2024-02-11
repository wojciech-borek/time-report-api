<?php

namespace App\Application\Command\Contractor;

use App\Domain\Entity\Contractor;
use App\Domain\Repository\ContractorRepositoryInterface;
use App\Infrastructure\Repository\Contractor\ContractorRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class DeleteContractorHandler
{

    public function __construct(private ContractorRepositoryInterface $contractorRepository) {
    }

    public function __invoke(DeleteContractorCommand $contractorCommand) {
        $contractor =$this->contractorRepository->findOne($contractorCommand->getId());
        if (null === $contractor) {
            return;
        }
        $this->contractorRepository->remove($contractor);
    }

}

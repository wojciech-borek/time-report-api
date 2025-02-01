<?php

namespace App\Application\Command\Contractor;

use App\Domain\Entity\Contractor;
use App\Domain\Repository\ContractorRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class CreateContractorHandler
{

    public function __construct(private ContractorRepositoryInterface $contractorRepository) {
    }

    public function __invoke(CreateContractorCommand $contractorCommand) {
        $contractor = new Contractor();
        $contractor->setName($contractorCommand->getName());
        $contractor->setEmail($contractorCommand->getEmail());
        $this->contractorRepository->save($contractor);
        return  $contractor;
    }

}

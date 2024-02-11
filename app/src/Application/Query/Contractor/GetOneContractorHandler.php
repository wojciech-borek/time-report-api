<?php


namespace App\Application\Query\Contractor;


use App\Domain\Entity\Contractor;
use App\Domain\Exception\MissingContractorException;
use App\Domain\Repository\ContractorRepositoryInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetOneContractorHandler
{
    public function __construct(private ContractorRepositoryInterface $contractorRepository) {
    }

    public function __invoke(GetOneContractorQuery $query): Contractor {

        $contractor = $this->contractorRepository->findOne($query->getId());
        if (null === $contractor) {
            throw new MissingContractorException($query->getId());
        }
        return $contractor;
    }
}
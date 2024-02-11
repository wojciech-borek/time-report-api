<?php


namespace App\Application\Query\Contractor;


use App\Domain\Repository\ContractorRepositoryInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetContractorsHandler
{
    public function __construct(private ContractorRepositoryInterface $contractorRepository) {
    }

    public function __invoke(GetContractorsQuery $query): Paginator {
        return $this->contractorRepository->getContractors($query->getPage(),$query->getLimit());

    }
}
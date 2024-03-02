<?php


namespace App\Application\Query\TimeSpent;


use ApiPlatform\Api\IriConverterInterface;
use App\Domain\Repository\TimeSpentRepositoryInterface;
use App\Infrastructure\Repository\Contractor\ContractorRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class GetTimeSpentHandler
{
    public function __construct(
        private TimeSpentRepositoryInterface $repository,
        private ContractorRepository $contractorRepository,
        private IriConverterInterface $iriConverter

    ) {
    }

    public function __invoke(GetTimeSpentQuery $query): Paginator {
        $filters = $query->getFilters();
        $contractor = null;
        if (!empty($filters['contractor'])) {
            $contractorResource = $this->iriConverter->getResourceFromIri($filters['contractor']);
            $contractor = $this->contractorRepository->find($contractorResource->id);
        }
        return $this->repository->getTimeSpent($query->getPage(), $query->getLimit(), $contractor);

    }
}
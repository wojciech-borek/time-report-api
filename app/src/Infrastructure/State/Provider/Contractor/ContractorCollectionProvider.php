<?php

namespace App\Infrastructure\State\Provider\Contractor;

use ApiPlatform\Exception\InvalidArgumentException;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\ArrayPaginator;
use ApiPlatform\State\Pagination\Pagination;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use App\Application\Command\MessengerQueryBus;
use App\Application\Query\Contractor\GetContractorsQuery;
use App\Infrastructure\Resource\ContractorResource;

class ContractorCollectionProvider implements ProviderInterface
{
    public function __construct(
        private MessengerQueryBus $messengerQueryBus,
        private Pagination        $pagination,
    ) {
    }

    /**
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return ArrayPaginator
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ArrayPaginator {
        $page = $offset = $limit = null;

        if ($this->pagination->isEnabled($operation, $context)) {
            [$page, $offset, $limit] = $this->pagination->getPagination($operation, $context);
        }
        $modelQuery = $this->messengerQueryBus->handle(new GetContractorsQuery($page, $limit));
        $resources = [];
        foreach ($modelQuery as $model) {
            $resources[] = ContractorResource::fromModel($model);
        }

        $firstResult = $modelQuery->getQuery()->getFirstResult();
        $maxResults = $modelQuery->getQuery()->getMaxResults();
        return new ArrayPaginator($resources, $firstResult, $maxResults);

    }
}
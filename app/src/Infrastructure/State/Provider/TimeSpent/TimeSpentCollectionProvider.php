<?php

namespace App\Infrastructure\State\Provider\TimeSpent;

use ApiPlatform\Api\IriConverterInterface;
use ApiPlatform\Exception\InvalidArgumentException;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\ArrayPaginator;
use ApiPlatform\State\Pagination\Pagination;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use App\Application\Command\MessengerQueryBus;
use App\Application\Query\Contractor\GetContractorsQuery;
use App\Application\Query\TimeSpent\GetTimeSpentQuery;
use App\Infrastructure\Resource\TimeSpentResource;

class TimeSpentCollectionProvider implements ProviderInterface
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

        $filters = $context['filters'] ?? [];

        if ($this->pagination->isEnabled($operation, $context)) {
            [$page, $offset, $limit] = $this->pagination->getPagination($operation, $context);
        }
        $entities = $this->messengerQueryBus->handle(new GetTimeSpentQuery($page, $limit, $filters));
        $resources = [];
        foreach ($entities as $entity) {
            $resources[] = TimeSpentResource::fromEntity($entity);
        }

        $firstResult = $entities->getQuery()->getFirstResult();
        $maxResults = $entities->getQuery()->getMaxResults();
        return new ArrayPaginator($resources, $firstResult, $maxResults);

    }
}
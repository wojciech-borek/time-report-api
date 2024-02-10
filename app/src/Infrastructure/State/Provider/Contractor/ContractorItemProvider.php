<?php

namespace App\Infrastructure\State\Provider\Contractor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\ArrayPaginator;
use ApiPlatform\State\Pagination\Pagination;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use App\Application\Command\MessengerQueryBus;
use App\Application\Query\GetContractors\GetContractorsQuery;
use App\Application\Query\GetContractors\GetOneContractorQuery;
use App\Infrastructure\Resource\ContractorResource;

class ContractorItemProvider implements ProviderInterface
{
    public function __construct(
        private MessengerQueryBus $messengerQueryBus,
    ) {
    }


    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ContractorResource {
        $id = $uriVariables['id'];
        $model = $this->messengerQueryBus->handle(new GetOneContractorQuery($id));
        return  ContractorResource::fromModel($model);


    }
}
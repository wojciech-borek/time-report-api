<?php

namespace App\Infrastructure\State\Provider\TimeSpent;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Application\Command\MessengerQueryBus;
use App\Application\Query\Contractor\GetOneContractorQuery;
use App\Application\Query\TimeSpent\GetOneTimeSpentQuery;
use App\Domain\Exception\MissingTimeSpentException;
use App\Infrastructure\Resource\ContractorResource;
use App\Infrastructure\Resource\TimeSpentResource;

class TimeSpentItemProvider implements ProviderInterface
{
    public function __construct(
        private MessengerQueryBus $messengerQueryBus,
    ) {
    }

    /**
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return TimeSpentResource
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): TimeSpentResource {
        $id = $uriVariables['id'];
        $entity = $this->messengerQueryBus->handle(new GetOneTimeSpentQuery($id));
        if(empty($entity)){
            throw new MissingTimeSpentException($id);
        }
        return  TimeSpentResource::fromEntity($entity);


    }
}
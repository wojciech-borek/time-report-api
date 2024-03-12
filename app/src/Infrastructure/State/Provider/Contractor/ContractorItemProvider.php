<?php

namespace App\Infrastructure\State\Provider\Contractor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Application\Command\MessengerQueryBus;
use App\Application\Query\Contractor\GetOneContractorQuery;
use App\Domain\Exception\MissingContractorException;
use App\Infrastructure\Resource\ContractorResource;

class ContractorItemProvider implements ProviderInterface
{
    public function __construct(
        private MessengerQueryBus $messengerQueryBus,
    ) {
    }

    /**
     * @param Operation $operation
     * @param array $uriVariables
     * @param array $context
     * @return ContractorResource
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): ContractorResource {
        $id = $uriVariables['id'];
        $entity = $this->messengerQueryBus->handle(new GetOneContractorQuery($id));
        if(empty($entity)){
            throw new MissingContractorException($id);
        }
        return  ContractorResource::fromEntity($entity);


    }
}
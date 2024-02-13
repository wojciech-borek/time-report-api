<?php

namespace App\Infrastructure\State\Processor\Contractor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Application\Command\Contractor\CreateContractorCommand;
use App\Application\Command\MessengerQueryBus;
use App\Infrastructure\Resource\ContractorResource;
use Webmozart\Assert\Assert;

final class CreateContractorProcessor implements ProcessorInterface
{

    public function __construct(private MessengerQueryBus $messengerQueryBus) {
    }


    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []) {
        Assert::isInstanceOf($data, ContractorResource::class);
        Assert::notEmpty($data->name);
        Assert::notEmpty($data->email);
        Assert::email($data->email);

        $command = new CreateContractorCommand(
            $data->name,
            $data->email
        );
        $entity = $this->messengerQueryBus->handle($command);

        return ContractorResource::fromEntity($entity);

    }
}
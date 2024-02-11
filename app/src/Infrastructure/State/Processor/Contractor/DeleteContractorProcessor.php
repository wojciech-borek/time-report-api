<?php

namespace App\Infrastructure\State\Processor\Contractor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Application\Command\Contractor\CreateContractorCommand;
use App\Application\Command\Contractor\DeleteContractorCommand;
use App\Application\Command\MessengerQueryBus;
use App\Infrastructure\Resource\ContractorResource;
use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;

final class DeleteContractorProcessor implements ProcessorInterface
{

    public function __construct(private MessageBusInterface $bus) {
    }


    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []) {
        Assert::isInstanceOf($data, ContractorResource::class);
        $this->bus->dispatch(new DeleteContractorCommand($data->id));
        return null;
    }
}
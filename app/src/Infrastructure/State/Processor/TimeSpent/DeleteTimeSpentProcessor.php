<?php

namespace App\Infrastructure\State\Processor\TimeSpent;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Application\Command\TimeSpent\DeleteTimeSpentCommand;
use App\Infrastructure\Resource\TimeSpentResource;
use Symfony\Component\Messenger\MessageBusInterface;
use Webmozart\Assert\Assert;

final class DeleteTimeSpentProcessor implements ProcessorInterface
{

    public function __construct(private MessageBusInterface $bus) {
    }


    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []) {
        Assert::isInstanceOf($data, TimeSpentResource::class);
        $this->bus->dispatch(new DeleteTimeSpentCommand($data->id));
        return null;
    }
}
<?php

namespace App\Infrastructure\State\Processor\TimeSpent;

use ApiPlatform\Exception\InvalidArgumentException;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Application\Command\MessengerQueryBus;
use App\Application\Command\TimeSpent\CreateTimeSpentCommand;
use App\Infrastructure\Resource\ContractorResource;
use App\Infrastructure\Resource\TimeSpentResource;
use Webmozart\Assert\Assert;

final class CreateTimeSpentProcessor implements ProcessorInterface
{

    public function __construct(private MessengerQueryBus $messengerQueryBus) {
    }


    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []) {
        Assert::isInstanceOf($data, TimeSpentResource::class);
        Assert::notEmpty($data->description);
        Assert::natural($data->time);
        Assert::notEmpty($data->contractor);
        Assert::notEmpty($data->date);
        Assert::isInstanceOf($data->contractor, ContractorResource::class);
        try {
            new \DateTime($data->date);
        } catch (\Exception $ex) {
            throw new InvalidArgumentException('Nieprawidłowy format daty');
        }
        $command = new CreateTimeSpentCommand(
            $data->description,
            $data->time,
            $data->contractor->id,
            $data->date
        );
        $entity = $this->messengerQueryBus->handle($command);

        return TimeSpentResource::fromEntity($entity);

    }
}
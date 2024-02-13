<?php


namespace App\Infrastructure\Resource;


use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use App\Domain\Entity\TimeSpent;
use App\Infrastructure\State\Processor\TimeSpent\CreateTimeSpentProcessor;
use App\Infrastructure\State\Processor\TimeSpent\DeleteTimeSpentProcessor;
use App\Infrastructure\State\Provider\TimeSpent\TimeSpentItemProvider;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'TimeSpent',
    operations: [
            new Get(
                provider: TimeSpentItemProvider::class,
                normalizationContext: ['groups' => ['time-spent:read']]
            ),
            new Post(
                processor: CreateTimeSpentProcessor::class,
                normalizationContext: ['groups' => ['time-spent:read']]
            ),
            new Delete(
                provider: TimeSpentItemProvider::class,
                processor: DeleteTimeSpentProcessor::class,
            ),
        ],

)]
final class TimeSpentResource
{
    public function __construct(
        #[ApiProperty(readable: false, writable: false, identifier: true)]
        public ?int $id = null,

        #[Assert\NotBlank]
        public ?string $description = '',

        #[Assert\NotNull]
        #[Assert\PositiveOrZero]
        public int $time = 0,

        #[Assert\NotNull]
        #[Groups('time-spent:read')]
        public ?ContractorResource $contractor = null,

    ) {
    }


    #[Pure] public static function fromEntity(TimeSpent $timeSpent): self {
        return new self(
            $timeSpent->getId(),
            $timeSpent->getDescription(),
            $timeSpent->getTime(),
            ContractorResource::fromEntity($timeSpent->getContractor()),
    );
    }

}
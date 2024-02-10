<?php


namespace App\Infrastructure\Resource;


use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Domain\Entity\Contractor;
use App\Infrastructure\State\Processor\Contractor\CreateContractorProcessor;
use App\Infrastructure\State\Provider\Contractor\ContractorCollectionProvider;
use App\Infrastructure\State\Provider\Contractor\ContractorItemProvider;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'Contractor',
    operations: [
        new Post(
            processor: CreateContractorProcessor::class,
        ),
        new GetCollection(
            provider: ContractorCollectionProvider::class,
        ),
        new Get(
            provider: ContractorItemProvider::class,
        ),
    ],
)]
final class ContractorResource
{
    public function __construct(
        #[ApiProperty(readable: false, writable: false, identifier: true)]
        public ?int $id = null,

        #[Assert\NotBlank]
        public ?string $name = null,

        #[Assert\NotBlank]
        #[Assert\Email]
        public ?string $email = null,
    ) {
    }


    #[Pure] public static function fromModel(Contractor $contractor): self {
        return new self(
            $contractor->getId(),
            $contractor->getName(),
            $contractor->getEmail(),
        );
    }

}
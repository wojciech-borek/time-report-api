<?php

namespace App\Infrastructure\Filter;


use ApiPlatform\Doctrine\Common\Filter\SearchFilterInterface;
use ApiPlatform\Doctrine\Orm\Filter\AbstractFilter;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class TimeSpentSearchFilter extends AbstractFilter
{



    public function getDescription(string $resourceClass): array
    {
        return [
            'contractor' => [
                'property' => 'contractor',
                'type' => 'string',
                'required' => false,
                'description' => 'Filter by contractor',
            ],
            'created_at' => [
                'property' => 'created_at',
                'type' => 'string',
                'required' => false,
                'description' => 'Filter by created at',
            ],
        ];
    }

    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, Operation $operation = null, array $context = []): void {
        // TODO: Implement filterProperty() method.
    }
}
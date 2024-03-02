<?php


namespace App\Application\Query\TimeSpent;

use App\Application\Command\CommandInterface;

class GetTimeSpentQuery implements CommandInterface
{

    public function __construct(private int $page,private int $limit,private array $filters = []) {
    }

    /**
     * @return int
     */
    public function getPage(): int {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getLimit(): int {
        return $this->limit;
    }

    /**
     * @return array
     */
    public function getFilters(): array {
        return $this->filters;
    }



}
<?php


namespace App\Application\Query\Contractor;

use App\Application\Command\CommandInterface;

class GetContractorsQuery implements CommandInterface
{

    public function __construct(private int $page,private int $limit) {
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


}
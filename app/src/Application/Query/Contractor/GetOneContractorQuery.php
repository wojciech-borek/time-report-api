<?php


namespace App\Application\Query\Contractor;

use App\Application\Command\CommandInterface;

class GetOneContractorQuery implements CommandInterface
{

    public function __construct(private int $id) {
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

}
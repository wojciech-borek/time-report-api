<?php


namespace App\Application\Query\TimeSpent;

use App\Application\Command\CommandInterface;

class GetOneTimeSpentQuery implements CommandInterface
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
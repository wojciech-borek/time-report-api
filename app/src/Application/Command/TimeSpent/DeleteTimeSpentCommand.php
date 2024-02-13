<?php


namespace App\Application\Command\TimeSpent;

use App\Application\Command\CommandInterface;

final class DeleteTimeSpentCommand implements CommandInterface
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
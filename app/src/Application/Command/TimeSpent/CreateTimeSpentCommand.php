<?php


namespace App\Application\Command\TimeSpent;

use App\Application\Command\CommandInterface;

final class CreateTimeSpentCommand implements CommandInterface
{

    public function __construct(private string $description, private int $time, private int $contractor_id) {
    }

    /**
     * @return string
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getTime(): int {
        return $this->time;
    }

    /**
     * @return int
     */
    public function getContractorId(): int {
        return $this->contractor_id;
    }


}
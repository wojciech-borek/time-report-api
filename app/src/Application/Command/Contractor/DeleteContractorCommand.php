<?php


namespace App\Application\Command\Contractor;

use App\Application\Command\CommandInterface;

final class DeleteContractorCommand implements CommandInterface
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
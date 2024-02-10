<?php


namespace App\Application\Command\Contractor;

use App\Application\Command\CommandInterface;

final class CreateContractorCommand implements CommandInterface
{

    public function __construct(private string $name,private string $email) {
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

}
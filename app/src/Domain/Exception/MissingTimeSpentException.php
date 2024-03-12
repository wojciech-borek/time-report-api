<?php

namespace App\Domain\Exception;

use JetBrains\PhpStorm\Pure;

class MissingTimeSpentException extends \Exception
{
    #[Pure] public function __construct(int $id)
    {
        parent::__construct(sprintf('Cannot find TimeSpent with id %s',  $id));
    }
}
<?php

namespace App\Domain\Exception;

use JetBrains\PhpStorm\Pure;

class MissingContractorException extends \Exception
{
    #[Pure] public function __construct(int $id)
    {
        parent::__construct(sprintf('Cannot find Contractor with id %s',  $id));
    }
}
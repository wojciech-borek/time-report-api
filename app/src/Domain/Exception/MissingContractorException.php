<?php

namespace App\Domain\Exception;

use JetBrains\PhpStorm\Pure;

class MissingContractorException extends \RuntimeException
{
    #[Pure] public function __construct(int $id, int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct(sprintf('Cannot find Contractor with id %s',  $id), $code, $previous);
    }
}
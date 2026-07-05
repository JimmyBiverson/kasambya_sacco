<?php

namespace App\Exceptions;

class InactiveBranchException extends \Exception
{
    public function __construct(string $message = 'Cannot assign to an inactive branch.')
    {
        parent::__construct($message);
    }
}

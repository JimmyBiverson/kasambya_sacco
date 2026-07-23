<?php

namespace App\Exceptions;

class InactiveLoanProductException extends \RuntimeException
{
    public function __construct(string $message = 'Loan product is not active.')
    {
        parent::__construct($message);
    }
}

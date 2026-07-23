<?php

namespace App\Exceptions;

use Exception;

class InsufficientFundsException extends Exception
{
    public function __construct(
        int $required = 0,
        int $available = 0,
        string $message = 'Insufficient funds.',
        int $code = 422
    ) {
        if (empty($message) || $message === 'Insufficient funds.') {
            $message = "Insufficient funds. Required: UGX {$required}, Available: UGX {$available}.";
        }
        parent::__construct($message, $code);
    }
}

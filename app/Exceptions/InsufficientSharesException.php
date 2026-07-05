<?php

namespace App\Exceptions;

use Exception;

class InsufficientSharesException extends Exception
{
    public function __construct(
        int $required = 0,
        int $available = 0,
        string $message = 'Insufficient shares.',
        int $code = 422
    ) {
        if ($message === 'Insufficient shares.') {
            $message = "Insufficient shares. Required: {$required}, Available: {$available}.";
        }
        parent::__construct($message, $code);
    }
}

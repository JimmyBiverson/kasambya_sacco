<?php

namespace App\Exceptions;

use Exception;

class DormantAccountException extends Exception
{
    public function __construct(string $message = 'Cannot operate on a dormant savings account.', int $code = 422)
    {
        parent::__construct($message, $code);
    }
}

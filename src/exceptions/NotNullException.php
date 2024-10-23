<?php

namespace exceptions;

use Exception;
use Throwable;

class NotNullException extends Exception{
    public function __construct(string $message = "Dado nulo", int $code = 422, Throwable $previous = null){
        parent::__construct($message, $code, $previous);
    }

    public function __tostring(): string{
        return "[{$this->code}]: {$this->message}/n";
    }
}
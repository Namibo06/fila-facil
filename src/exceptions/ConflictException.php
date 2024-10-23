<?php

namespace exceptions;

use Exception;
use Throwable;

class ConflictException extends Exception{
    public function __construct(string $message = "Registro já existe", int $code = 409, Throwable $previous = null){
        parent::__construct($message, $code, $previous);
    }

    public function __tostring(): string{
        return "[{$this->code}]: {$this->message}/n";
    }
}
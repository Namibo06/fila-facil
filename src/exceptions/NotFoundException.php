<?php

namespace exceptions;

use Exception;
use Throwable;

class NotFoundException extends Exception{
    public function __construct(string $message = "Registro não encontrado", int $code = 404, Throwable $previous = null){
        parent::__construct($message, $code, $previous);
    }

    public function __tostring(): string{
        return "[{$this->code}]: {$this->message}/n";
    }
}
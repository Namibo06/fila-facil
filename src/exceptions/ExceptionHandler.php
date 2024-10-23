<?php

namespace exceptions;

class ExceptionHandler{
    public static function handleException($exception){
        echo "Erro: " .$exception->getMessage(). " (Código: ". $exception->getCode() .")";

        error_log($exception, 3, "logs/exceptions.log");
    }
}

set_exception_handler(["ExceptionHandler","handleException"]);
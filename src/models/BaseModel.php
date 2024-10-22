<?php

namespace models;

use Connection;

class BaseModel{
    protected static $pdo;

    public static function messageError(string $typeError,string $messageError,int $statusCode):array{
        return [
            "message" => $typeError. ": ".$messageError,
            "status" => $statusCode
        ];
    }

    public static function initConnection(): void{
        self::$pdo = Connection::Conn();

        if(!self::$pdo){
            BaseModel::messageError("Conexão com PDO","PDO não inicializou",500);
        }
    }

    public static function getPdo() {
        return self::$pdo; 
    }
}
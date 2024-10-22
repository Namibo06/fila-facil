<?php

namespace services;

use Dotenv\Dotenv;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$dotenv = Dotenv::createImmutable(__DIR__ );
$dotenv->load();

class TokenJwtService{
    public static function createToken(string $userId): string{
       $key = $_ENV['SECRET_KEY_JWT'];
       $payload = array(
        'iss' => 'localhost',
        'sub' => $userId,
        'iat' => time(),
        'exp' => time() + (60 * 60 * 24)
       );

       return JWT::encode($payload,$key,'HS256');
    }

    public static function verifyToken(string $token): array{
        $key = $_ENV['SECRET_KEY_JWT'];
        $algorithm = 'HS256';

        try{
            $decoded = JWT::decode($token, new Key($key, $algorithm));
            $userId = $decoded->sub;

            return [
                "message" => "Token verificado com sucesso",
                "user_id" => $userId,
                "status" => 200
            ];
        }catch(Exception $e){
            return [
                "message" => "Error:".$e->getMessage(),
                "status" => 400
            ];
        }
    }
}
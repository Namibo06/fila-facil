<?php

namespace services;

use Exception;
use Firebase\JWT\JWT;

class TokenJwt{
    public static function createToken(string $userId): string{
       $key = "secret_key";
       $payload = array(
        'iss' => 'localhost',
        'sub' => $userId,
        'iat' => time(),
        'exp' => time() + (60 * 60 * 24)
       );

       return JWT::encode($payload,$key,'HS256');
    }

    public static function verifyToken(string $token): array{
        $key = "secret_key";

        try{
            $decoded = JWT::decode($token,$key);
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
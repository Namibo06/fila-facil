<?php

namespace models;

use Exception;
use PDO;
use PDOException;
use services\TokenJwtService;

class LoginModel extends BaseModel{
    public function __construct()
    {
        self::initConnection();

        if (!self::$pdo) {
            self::messageError("Erro de conexão", "Não foi possível conectar ao banco de dados", 500);
        }
    }  

    public static function authenticate(array $data): array{
        $email = $data['email'];
        $password = $data['password'];

        $query = "SELECT id,password FROM tb_user WHERE email = ?";
        $sql = self::$pdo->prepare($query);
        $sql->execute($email);
        $result = $sql->fetch(PDO::FETCH_OBJ);
        $passwordWithHash = $result->password;
        $id = $result->id;

        $verifyPassword = password_verify($password,$passwordWithHash);

        if(!$verifyPassword){
            return [
                "message" => "Senhas não batem",
                "status" => 422
            ];
        }
        
        try{
            $token = TokenJwtService::createToken($id);

            $query = "
                UPDATE tb_user
                SET token = ?
                WHERE id = ?
            ";
            $sql = self::$pdo->prepare($query);
            
            if($sql->execute(array($token,$id))){
                return [
                    "message" => "Usuário logado com sucesso",
                    "status" => 200,
                    "token" => $token,
                    "user_id" => $id
                ];
            }
            
            return [
                "message" => "Não foi possivel realizar login",
                "status" => 400
            ];

        }catch(PDOException $e){
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel autenticar usuário",
                "status" => "500"
            ];
        }
    }
}
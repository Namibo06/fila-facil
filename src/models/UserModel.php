<?php

namespace models;

use Connection;
use Exception;
use PDO;
use PDOException;
use services\TokenJwt;

class UserModel{
    private static $pdo;

    public static function messageError(string $typeError,string $messageError,int $statusCode):array{
        return [
            "message" => $typeError. ": ".$messageError,
            "status" => $statusCode
        ];
    }

    public static function initConnection(): void{
        self::$pdo = Connection::Conn();

        if(!self::$pdo){
            UserModel::messageError("Conexão com PDO","PDO não inicializou",500);
        }
    }

    public static function verifyExistsByEmail(string $email):bool{
        $query = "
            SELECT email 
            FROM tb_user
            WHERE email = ?
        ";
        $sql = self::$pdo->prepare($query);
        $sql->execute(array($email));

        return $sql->rowCount() === 1;
    }

    public static function existsByUuid(string $uuid):bool{
        $query = "
            SELECT uuid 
            FROM tb_user
            WHERE uuid = ?
        ";
        $sql = self::$pdo->prepare($query);
        $sql->execute(array($uuid));

        return $sql->rowCount() === 1;
    }

    public static function createUser(array $data): array{
        $firstName = $data['first_name'];
        $lastName = $data['last_name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = password_hash($data['password'],PASSWORD_BCRYPT,['cost' => 10]);

        try{
            $existsEmail = UserModel::verifyExistsByEmail($email);

            if(!$existsEmail){
                return [
                    "message" => "Conflito: Já existe uma conta ativa com este email",
                    "status" => "409"
                ];
            }

            $query = "INSERT INTO tb_user
            (first_name,last_name,email,phone,password,created_at) 
            VALUES (?,?,?,?,?,NOW)
            ";
            $sql = self::$pdo->prepare($query);

            if($sql->execute(array($firstName,$lastName,$email,$phone,$password))){
                return [
                    "message" => "Sucesso: Usuário criado",
                    "status" => "201"
                ];
            }

            return [
                "message" => "Erro: Falha ao tentar cadastrar usuário",
                "status" => "400"
            ];

        }catch(PDOException $e){
            UserModel::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            UserModel::messageError("Geral",$e->getMessage(),400);
        }
    }

    public static function authenticate(array $data): array{
        $email = $data['email'];
        $password = $data['password'];

        $query = "SELECT id,password FROM tb_user WHERE email = ?";
        $sql = self::$pdo->prepare($query);
        $sql->execute($email);
        $result = self::$pdo->fetch(PDO::FETCH_OBJ);
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
            $token = TokenJwt::createToken($id);

            $query = "
                UPDATE tb_user
                SET token = ?
                WHERE id = ?
            ";
            $sql = self::$pdo->prepare($query);
            
            if($sql->execute($token,$id)){
                return [
                    "message" => "Usuário logado com sucesso",
                    "status" => 200
                ];
            }
            
            return [
                "message" => "Não foi possivel realizar login",
                "status" => 400
            ];

        }catch(PDOException $e){
            UserModel::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            UserModel::messageError("Geral",$e->getMessage(),400);
        }
    }

    /**uma gestão de usuários para nós,fazer depois uns gráficos com chart.js */
    public static function getAllUsers(): object{
        try{
            $query = "SELECT * FROM tb_users";
            $sql = self::$pdo->prepare($query);
            $sql->execute();

            if($sql->rowCount() === 0){
                return [
                    "message" => "Nenhum registro encontrado",
                    "status" => 404
                ];
            }

            return $sql->fetch(PDO::FETCH_OBJ);

        }catch(PDOException $e){
            UserModel::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            UserModel::messageError("Geral",$e->getMessage(),400);
        }
    }

    public static function getUserByUuid(string $uuid): object{
        try{
            $query = "SELECT * FROM tb_users WHERE id = ?";
            $sql = self::$pdo->prepare($query);
            $sql->execute(array($uuid));

            if($sql->rowCount() === 0){
                return [
                    "message" => "Nenhum registro encontrado",
                    "status" => 404
                ];
            }

            return $sql->fetch(PDO::FETCH_OBJ);

        }catch(PDOException $e){
            UserModel::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            UserModel::messageError("Geral",$e->getMessage(),400);
        }
    }

    public static function updateUser(string $uuid, array $data): array{
        $firstName = $data['first_name'];
        $lastName = $data['last_name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = password_hash($data['password'],PASSWORD_BCRYPT,['cost' => 10]);

        try{
            $existsUser = UserModel::existsByUuid($uuid);
            if(!$existsUser){
                return [
                    "message" => "Usuário não encontrado",
                    "status" => 404
                ];
            }

            $query = "
                UPDATE tb_user 
                SET first_name = $firstName,
                last_name = $lastName,
                email = $email,
                phone = $phone,
                password = $password
                updated_at = NOW
                WHERE id = $uuid
            ";
            $sql = self::$pdo->prepare($query);
            
            if($sql->execute()){
                return [
                    "message" => "Usuário atualizado com sucesso",
                    "status" => 200
                ];
            }
            
            return [
                "message" => "Não foi possivel atualizar usuário",
                "status" => 400
            ];

        }catch(PDOException $e){
            UserModel::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            UserModel::messageError("Geral",$e->getMessage(),400);
        }
    }

    public static function deleteUser(string $uuid): array{
        try{
            $existsUser = UserModel::existsByUuid($uuid);
            if(!$existsUser){
                return [
                    "message" => "Usuário não encontrado",
                    "status" => 404
                ];
            }

            $query = "DELETE FROM tb_users WHERE id = ?";
            $sql = self::$pdo->prepare($query);
            $sql->execute(array($uuid));

            return [
                "message" => "Usuário deletado com sucesso",
                "status" => 204
            ];

        }catch(PDOException $e){
            UserModel::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            UserModel::messageError("Geral",$e->getMessage(),400);
        }
    }
}

UserModel::initConnection();
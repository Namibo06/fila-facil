<?php

namespace models;

use Exception;
use PDO;
use PDOException;
use Ramsey\Uuid\Uuid;

class UserModel extends BaseModel{
    public function __construct()
    {
        self::initConnection();

        if (!self::$pdo) {
            self::messageError("Erro de conexão", "Não foi possível conectar ao banco de dados", 500);
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

    public static function addPhotoProfile($uuid,$file): array{
        try{
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
                $directory = "src/storage/profile/";
    
                if(!is_dir($directory)){
                    mkdir($directory,0777,true);
                }
        
                $filename = basename($file['name']);
                $awayPhoto = $directory . $filename;
        
                if($file['error'] === UPLOAD_ERR_OK){
                    if(move_uploaded_file($file['tmp_name'],$awayPhoto)){
                        $query = "
                            UPDATE tb_user 
                            SET profile = ?
                            WHERE uuid = ?
                        ";
                        $sql = self::$pdo->prepare($query);
                        $sql->execute(array($filename, $uuid));
        
                        return [
                            "message" => "Foto adicionada",
                            "filename" => $filename,
                            "status" => "200"
                        ];
                    }
                }
        
                return [
                    "message" => "Falha ao tentar adicionar foto",
                    "status" => "500"
                ];
            }
            
        }catch(PDOException $e){
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel salvar foto",
                "status" => "500"
            ];
        }
    }

    public static function createUser(array $data): array{
        $name = $data['name'];
        $email = $data['email'];
        $phone = $data['phone'];
        $password = password_hash($data['password'],PASSWORD_BCRYPT,['cost' => 10]);

        try{
            $uuid = Uuid::uuid4();

            $existsEmail = UserModel::verifyExistsByEmail($email);

            if(!$existsEmail){
                return [
                    "message" => "Conflito: Já existe uma conta ativa com este email",
                    "status" => "409"
                ];
            }

            $query = "INSERT INTO tb_user
            (id,name,email,phone,password,created_at) 
            VALUES (?,?,?,?,?,NOW)
            ";
            $sql = self::$pdo->prepare($query);

            if($sql->execute(array($uuid,$name,$email,$phone,$password))){
                return [
                    "message" => "Usuário criado",
                    "status" => "201"
                ];
            }

            return [
                "message" => "Falha ao tentar cadastrar usuário",
                "status" => "400"
            ];

        }catch(PDOException $e){
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel criar usuário",
                "status" => "500"
            ];
        }
    }

    /**uma gestão de usuários para nós,fazer depois uns gráficos com chart.js */
    public static function getAllUsers(): object | array{
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
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel retornar usuários",
                "status" => "500"
            ];
        }
    }

    public static function getUserByUuid(string $uuid): object | array{
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
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel retornar usuário",
                "status" => "500"
            ];
        }
    }

    public static function updateUser(string $uuid, array $data): array{
        if(!isset($_FILES['file'])){
            $profile = null;
        }
        $profile =$_FILES['file'];
        $addProfile = UserModel::addPhotoProfile($uuid,$profile);
        $filenameProfile = $addProfile["filename"];

        $name = $data['name'];
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
                SET name = $name,
                profile = $filenameProfile,
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
                "message" => "Usuário não atualizado",
                "status" => 400
            ];

        }catch(PDOException $e){
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel atualizar usuário",
                "status" => "500"
            ];
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
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel deletar usuário",
                "status" => "500"
            ];
        }
    }
}
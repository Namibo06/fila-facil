<?php

namespace models;

use Exception;
use PDOException;

class AddressModel extends BaseModel{
    public function __construct()
    {
        self::initConnection();

        if (!self::$pdo) {
            self::messageError("Erro de conexão", "Não foi possível conectar ao banco de dados", 500);
        }
    }  


    public static function verifyAddressInDatabase(string $cep,string $typeUser): array{

        try{
            $query = "
                SELECT cep FROM tb_address_$typeUser
                WHERE cep = ? 
            ";
            $sql = self::$pdo->prepare($query);
            $sql->execute(array($cep));

            if($sql->rowCount() ===  0){
                return [
                    "message" => "Nenhum registro encontrado",
                    "status" => 404
                ];
            }

        }catch(PDOException $e){
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel consultar endereço no banco",
                "status" => "500"
            ];
        }
    }

    public static function createAddress(array $data): array{
        $cep = $data["cep"];
        $state = $data['uf'];
        $city = $data['localidade'];
        $neighborhood = $data['bairro'];
        $street = $data['logradouro'];
        $number = $data['number'];
        $complement = $data['complemento'];
        $typeUser = $data['type_user'];

        try{
            $query = "
                INSERT INTO tb_address_$typeUser
                (cep, state, city, neighborhood, street, complemet, number)
                VALUES (?,?,?,?,?,?,?)
            ";
            $sql = self::$pdo->prepare($query);

            if($sql->execute(array($cep,$state,$city,$neighborhood,$street,$complement,$number))){
                return [
                    "message" => "Endereço criado com sucesso",
                    "status" => 201
                ];
            }

            return [
                "message" => "Não foi possivel criar endereço",
                "status" => 400
            ];
        }catch(PDOException $e){
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel criar endereço",
                "status" => "500"
            ];
        }
    }
}
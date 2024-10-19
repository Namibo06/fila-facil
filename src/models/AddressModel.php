<?php

namespace models;

use Exception;
use PDOException;

class AddressModel{
    private static $pdo;

    public static function verifyAddressInDatabase($cep){
        try{
            $query = "
                SELECT cep FROM 
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
            UserModel::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            UserModel::messageError("Geral",$e->getMessage(),400);
        }
    }

    public static function createAddress($data,$number){
        $cep = $data["cep"];
        $state = $data['uf'];
        $city = $data['localidade'];
        $neighborhood = $data['bairro'];
        $street = $data['logradouro'];
        $complement = $data['complemento'];

        try{
            $query = "
                INSERT INTO tb_user
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
            UserModel::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            UserModel::messageError("Geral",$e->getMessage(),400);
        }
    }
}
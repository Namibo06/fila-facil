<?php

namespace models;

use Exception;
use PDOException;

class ImageModel extends BaseModel{
    public function __construct()
    {
        self::initConnection();

        if (!self::$pdo) {
            self::messageError("Erro de conexão", "Não foi possível conectar ao banco de dados", 500);
        }
    }   

    /*Quando cria um evento cria imagem, que alimenta a tabela associativa aqui*/
    public static function getImages(string $event_id){
        try{
            //pegar do tb_event_image os image_id
            //depois acessar o image_id que é o uuid do tb_image e recuperar as imagens

        }catch(PDOException $e){
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }
    }

    public static function addImages(){

    }

    public static function updateImages(){

    }

    public static function removeImages(){

    }
}

ImageModel::initConnection();
<?php

namespace models;

use Exception;
use PDO;
use PDOException;
use Ramsey\Uuid\Uuid;

class FavoriteModel extends BaseModel{
    public function __construct()
    {
        self::initConnection();

        if (!self::$pdo) {
            self::messageError("Erro de conexão", "Não foi possível conectar ao banco de dados", 500);
        }
    }   

    public static function verifyFavorite(string $favoriteId): bool{
        $query = "
            SELECT * FROM tb_favorite
            WHERE id = ?
        ";
        $sql = self::$pdo->prepare($query);
        $sql->execute(array($favoriteId));

        return $sql->rowCount() === 1;
    }

    public static function getAllFavorites(): array{
        $query = "
            SELECT * FROM tb_favorite
            WHERE id = ?
        ";
        $sql = self::$pdo->prepare($query);
        $sql->execute();

        if($sql->rowCount() === 0){
            FavoriteModel::messageError("Favoritos","Nenhum registro encontrado",404);
        }

        return $sql->fetch(PDO::FETCH_OBJ);
    }

    public static function saveFavorite(array $data): array{
        $favoriteId = $data['favorite_id'];
        $userId = $data['user_id'];
        $eventId = $data['event_id'];

        $existsFavorite = FavoriteModel::verifyFavorite($favoriteId);
        if($existsFavorite){
            FavoriteModel::messageError("Favoritos","Evento já favoritado",409);
        }

        $uuid = Uuid::uuid4();

        try{
            $query = "
                INSERT INTO tb_favorite
                (id,event_id)
                VALUES (?,?)
            ";
            $sql = self::$pdo->prepare($query);
            
            if($sql->execute(array($uuid,$eventId))){
                $query = "
                    INSERT INTO tb_favorite_user
                    (favorite_id,user_id)
                    VALUES (?,?)
                ";
                $sql = self::$pdo->prepare($query);
                $sql->execute(array($favoriteId,$userId));

                return [
                    "message" => "Evento adicionado aos favoritos",
                    "status" => "201"
                ];
            }

            return [
                "message" => "Falha ao associar favorito ao usuário",
                "status" => "409"
            ];

        }catch(PDOException $e){
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel favoritar",
                "status" => 500 
            ];
        }
    }

    public static function unsaveFavorite(array $data): array{
        $favoriteId = $data['favorite_id'];
        $userId = $data['user_id'];
        $uuid = $data['uuid'];

        $existsFavorite = FavoriteModel::verifyFavorite($favoriteId);
        if(!$existsFavorite){
            FavoriteModel::messageError("Favoritos","Evento não favoritado",404);
        }

        try{
            $query = "
                DELETE FROM tb_favorite_user
                WHERE favorite_id = ? AND 
                user_id = ? 
            ";
            $sql = self::$pdo->prepare($query);
            
            if($sql->execute(array($favoriteId,$userId))){
                $query = "
                    DELETE FROM tb_favorite
                    WHERE uuid = ?
                ";
                $sql = self::$pdo->prepare($query);
                $sql->execute(array($uuid));

                return [
                    "message" => "Evento removido dos favoritos",
                    "status" => "204"
                ];
            }

            return [
                "message" => "Falha ao desassociar favorito ao usuário",
                "status" => "409"
            ];

        }catch(PDOException $e){
            self::messageError("Conexão com PDO",$e->getMessage(),500);
        }catch(Exception $e){
            self::messageError("Geral",$e->getMessage(),400);
        }finally{
            return [
                "message" => "Não foi possivel desfavoritar",
                "status" => 500 
            ];
        }
    }
}
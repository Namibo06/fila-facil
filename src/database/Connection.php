<?php

require "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Connection{
    private $pdo;

    public static function Conn(): ?PDO{
        define('MYSQL_HOST',$_ENV['MYSQL_HOST']);
        define('MYSQL_DATABASE',$_ENV['MYSQL_DATABASE']);
        define('MYSQL_USERNAME',$_ENV['MYSQL_USERNAME']);
        define('MYSQL_PASSWORD',$_ENV['MYSQL_PASSWORD']);

        function messageError(string $message): string{
            return "Erro: ".$message;
        }

        try{
            return new PDO("mysql: host=".MYSQL_HOST.";dbname=".MYSQL_DATABASE,MYSQL_USERNAME,MYSQL_PASSWORD);
        }catch(PDOException $e){
            messageError($e->getMessage());    
        }catch(Exception $e){
            messageError($e->getMessage());    
        }
    }  

    public function executeQuery($query, array $params = []): mixed{
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }
}
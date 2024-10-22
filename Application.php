<?php

class Application{
    function execute(): void{
        $url = isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Login';

        $url = ucfirst($url) . "Controller";

        if(file_exists("src/controllers/".$url.".php")){
            $namespaceWithClassName = "controllers\\".$url;
            
            require "src/controllers/" . $url . ".php";

            $controller = new $namespaceWithClassName();
            $controller->execute();
        }else{
            header("Location: error");
            exit();
        }
    }   
}
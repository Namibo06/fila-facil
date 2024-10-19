<?php

require "./src/controllers/LoginController.php";

class Application{
    function execute(): void{
        $url = isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Login';

        $url = ucfirst($url);

        $url .= "Controller";

        if(file_exists("controllers/".$url.".php")){
            $namespaceWithClassName = "controller//".$url;
            
            $controller = new $namespaceWithClassName();
            $controller->execute();
        }else{
            echo "
                <script>
                    window.location.href='error.php';
                </script>
            ";
        }
    }   
}
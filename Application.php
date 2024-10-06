<?php

// dá um require no LoginController 

class Application{
    function execute(){
        $url = isset($_GET['url']) ? explode('/',$_GET['url'])[0] : 'Login';

        $url = ucfirst($url);

        $url .= "Controller";

        if(file_exists("controllers/".$url.".php")){
            $namespaceWithClassName = "controller//".$url;
            
            $controller = new $namespaceWithClassName();
            $controller->execute();
        }else{
            //die("Controlador não existe");
            echo "
                <script>
                    window.location.href='error.php';
                </script>
            ";
        }
    }   
}
<?php

require "Application.php";

$autoload = function(string $class): void{
    include($class.".php");
};

//registrando carregamento automático
spl_autoload_register($autoload);

$app = new Application();
$app->execute();
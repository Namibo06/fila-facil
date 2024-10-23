<?php

namespace controllers;

use use_case\UserUseCase;

class RegisterController{
    private $view;
    private $useCase;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->view = new \views\MainView('register');

        $this->useCase = new UserUseCase();
    }

    /**Vai esperar cliques somente da página de registro, vai na model e retorna para página */
    public function execute(){
        if(isset($_POST['registerUserBtn'])){
            $data = filter_input_array(INPUT_POST,FILTER_DEFAULT);

            $createUser = $this->useCase->createUser($data);

            if($createUser['status'] === 201){
                echo '<meta http-equiv="refresh" content="0;url=login">';
            }
        }

        $this->view->render(array('titulo' => 'Register'));
    }
}
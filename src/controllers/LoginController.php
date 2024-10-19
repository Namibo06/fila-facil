<?php

namespace controllers;

use models\UserModel;

class LoginController{
    private $view;

    public function __construct()
    {
        session_start();
        $this->view = new \views\MainView('login');
    }

    public function execute(){
        if(isset($_POST['loginBtn'])){
            $data = filter_input_array(INPUT_POST,FILTER_DEFAULT);

            $payload = UserModel::authenticate($data);

            if($payload['status'] === 200){
                echo '<meta http-equiv="refresh" content="0;url=home">';
            }else{
                echo '<meta http-equiv="refresh" content="0;url=login">';
            }
        }

        $this->view->render(array('titulo' => 'Login'));
    }
}
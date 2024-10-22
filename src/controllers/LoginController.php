<?php

namespace controllers;

use \models\LoginModel;

class LoginController{
    private $view;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->view = new \views\MainView('login');
    }

    public function execute(){
        if(isset($_POST['loginBtn'])){
            $data = filter_input_array(INPUT_POST,FILTER_DEFAULT);

            $payload = LoginModel::authenticate($data);

            if($payload['status'] === 200){
                $token = $payload['token'];
                $userId = $payload['user_id'];
                $expireTimeToken = time() + (60 * 60 * 24);
                setcookie("token",$token,$expireTimeToken);
                setcookie("user_id",$userId,$expireTimeToken);

                echo '<meta http-equiv="refresh" content="0;url=home">';
            }
        }

        $this->view->render(array('titulo' => 'Login'));
    }
}
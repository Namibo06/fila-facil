<?php

namespace controllers;

use models\UserModel;

class HomeController{
    private $view;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->view = new \views\MainView("home");
    }

    public function execute(){
        if(isset($_COOKIE['user_id'])){
            $userId = $_COOKIE['user_id'];
            $getUser = UserModel::getUserByUuid($userId);
        }

        $this->view->render(array('titulo' => 'Home', 'getUser' => $getUser));
    }
}
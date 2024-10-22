<?php

namespace controllers;

class ErrorController{
    private $view;

    public function __construct()
    {   
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->view = new \views\MainView("error");
    }

    public function execute(){
        $this->view->render(array('title' => 'Error'));
    }
}
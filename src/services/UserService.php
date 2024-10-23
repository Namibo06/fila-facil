<?php

namespace services;

use models\UserModel;

class UserService{
    private $model;

    public function __construct(){
        $this->model = new UserModel();
    }

    public function create($data) :array{
        return $this->model->createUser($data);
    }

    public function verifyExistsEmail(string $email) :bool{
        return $this->model->verifyExistsByEmail($email);
    }
}
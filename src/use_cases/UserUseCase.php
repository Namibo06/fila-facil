<?php

namespace use_case;

use Exception;
use exceptions\NotNullException;
use exceptions\ConflictException;
use services\UserService;

class UserUseCase{
    private $service;

    public function __construct(){
        $this->service = new UserService();
    }

    public function createUser( array $data): array{
        try{
            $name = $data['name'];
            $email = $data['email'];
            $phone = $data['phone'];
            $password = password_hash($data['password'],PASSWORD_BCRYPT,['cost' => 10]);

            $existsEmail = $this->service->verifyExistsEmail($email);

            if(!$existsEmail){
                throw new ConflictException("Já existe uma conta ativa com este email");
            }

            if($name === null || $email === null || $password === null){
                throw new NotNullException("Nome, email ou senha nulo(s)");
            }

            $dataCreate[]=[];
            array_push($dataCreate,$name);
            array_push($dataCreate,$email);
            array_push($dataCreate,$phone);
            array_push($dataCreate,$password);

            return $this->service->create($dataCreate);
        }catch(Exception $e){
            error_log($e, 3, "logs/exceptions.log");
            throw new Exception($e->getMessage());
        }
    }
}
<?php

namespace controllers;

use models\AddressModel;
use services\Viacep;

class PerfilController{
    private $view;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->view = new \views\MainView('perfil');
    }

    public function execute(): void{
        if(isset($_POST['add_address_btn'])){
            $data = filter_input_array(INPUT_POST,FILTER_DEFAULT);
            $cep = $data['cep'];

            /**Esse type vai ser setado no cookie ou localStorage,
             * a partir se o que voltar do perfil tiver cnpj ou não
             */
            if(isset($_COOKIE['type_user'])){
                $typeUser = $_COOKIE['type_user'];
                $data[] = $typeUser;
            }
           
            $verifyAddress = AddressModel::verifyAddressInDatabase($cep,$typeUser);       
            $createInDatabase = AddressModel::createAddress($data);
        
            if($verifyAddress){
                $result = [
                    "message" => "Endereço verificado na base de dados",
                    "status" => 200
                ];
            }

            $viacepConsult = Viacep::getAddressViacep($cep);

            if($viacepConsult){
                $result = [
                    "message" => "Endereço consultado na ViaCep",
                    "status" => 200
                ];
            }

            if($createInDatabase){
                $result = [
                    "message" => "Endereço criado na base de dados",
                    "status" => 201
                ];
            }
        }

        $this->view->render(array('titulo' => 'Perfil','result' => $result));
    }
}
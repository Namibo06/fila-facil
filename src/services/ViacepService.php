<?php

namespace services;

use models\UserModel;

class ViacepService{

    public static function getAddressViacep(string $cep): array{
        $url = "https://viacep.com.br/ws/$cep/json/";

        $respose = file_get_contents($url);

        $data = json_decode($respose,true);

        if($data && isset($data['erro'])){
            UserModel::messageError("Viacep","Erro ao tentar consultar a Viacep",500);
        }else{
            return [
                "cep" => $data['cep'],
                "state" => $data['uf'],
                "city" => $data['localidade'],
                "neighborhood" => $data['bairro'],
                "street" => $data['logradouro'],
                "complement" => $data['complemento']
            ];
        }

        return [
            "message" => "Não foi possivel cosultar a Viacep",
            "status" => "500"
        ];
    }
}

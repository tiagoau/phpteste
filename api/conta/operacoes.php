<?php

/*
objeto json enviado 
{
  "id_pessoa_fk" : "7",
  "operacao"	:  "C",
  "transferencia"	: "0",
  "valor"	: "400.00",
}
*/

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../entities/conta_pessoa.php';



    $database = new Database();
    $db = $database->getConnection();

    $item = new Conta_Pessoa($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->id_pessoa_fk = $data->id_pessoa_fk;
    $item->operacao = $data->operacao;
    $item->transferencia = $data->transferencia;
    $item->valor = $data->valor;

    
    if($item->insertValor()){
        echo 'Credito realizado com sucesso.';
    } else{
        echo 'Operação Crédito não realizada.';
    }
?>
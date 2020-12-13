<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../entities/pessoa.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Pessoa($db);

    $stmt = $items->getPessoas();
    $itemCount = $stmt->rowCount();


    if($itemCount > 0){
        
        $pessoaArr = array();
        $pessoaArr["body"] = array();
        $pessoaArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "nome" => $nome,
                "cpf" => $cpf,
                "sexo" => $sexo,
                "criado_em" => $criado_em
            );

            array_push($pessoaArr["body"], $e);
        }
        echo json_encode($pessoaArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Nenhum registro encontrado")
        );
    }
?>
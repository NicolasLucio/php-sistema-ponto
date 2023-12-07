<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once __DIR__ . "/vendor/autoload.php";

use Backend\Connect;

$connect = new Connect();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    try
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data);

        if (empty($data->username) || empty($data->nome) || empty($data->password)){
            
            http_response_code(422);
            throw new Exception("Erro", 422);
        }

        if ($result = $connect->adminCreate($data))
        {
            $resultNome = $result->nome;
            $resultUsername = $result->username;
            $resultPassword = $result->password;
            $resultCheckbox = $result->checkbox;            
            $query = "INSERT INTO usuarios (id, nome, senha, username, admin) VALUES(null, '$resultNome', '$resultPassword', '$resultUsername', $resultCheckbox);";
            try
            {
                $connect->conn->exec($query);
                echo json_encode(array(
                    "message"=>"Usuario Cadastrado"                    
                ));
                die;                
            }
            catch (Exception $e)
            {
                echo json_encode(array(
                    "message"=>$e->getMessage()
                ));  
            }
        }
    }
    catch (Exception $e)
    {
        echo json_encode(array(
            "message"=>$e->getMessage()
        ));  
    }
}

<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once __DIR__ . "/vendor/autoload.php";

use Backend\Connect;

$connect = new Connect();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    try
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        if (empty($data->username) || empty($data->senha)){            
            http_response_code(422);
            throw new Exception("Campos Vazios", 422);            
        }
        if ($user = $connect->login($data->username, $data->senha))
        {   
            echo json_encode(array(
                "message"=>"Usuário Conectado",
                "username"=>$user->nome,
                "isAdmin"=>$user->admin,
                "userID"=>$user->id           
            ));
            die;
        }        
    }
    catch (Exception $e)
    {        
        echo json_encode(array(
            "message"=>$e->getMessage()
        ));    
    }
}

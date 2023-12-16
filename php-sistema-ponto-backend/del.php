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

        if($connect->del($data))
        {
            echo json_encode(array(
                "message"=>"Usuário Deletado",                
            ));
            die;
        }
    }
    catch(Exception $e)
    {
        echo json_encode(array(
            "message"=>$e->getMessage()
        )); 
    }    
}

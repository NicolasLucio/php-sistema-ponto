<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once __DIR__ . "/vendor/autoload.php";

use Backend\Main;
use Backend\Connect;

$main = new Main();
$connect = new Connect();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    try
    {
        $data = file_get_contents("php://input");
        $data = json_decode($data);

        if ($resultList = $connect->history($data))
        {           
            echo json_encode(array(
                "message"=>"Historico Acessado com Sucesso",
                "listHistory"=>$resultList
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


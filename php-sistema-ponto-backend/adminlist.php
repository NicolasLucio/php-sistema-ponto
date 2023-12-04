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
        if ($result = $connect->adminList())
        {
            echo json_encode(array(
                "message"=>"Lista de Usuarios Acessada com Sucesso",
                "listUsers"=>$result
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

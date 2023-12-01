<?php

namespace Backend;

use Exception;
use PDO;

class Connect{

    private $pathBD = __DIR__ . DIRECTORY_SEPARATOR . "../bdPonto.sql";
    public $conn;

    public function __construct()
    {        
        try
        {
            $conn = new PDO("sqlite:" . $this->pathBD);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = $conn;            
        }
        catch(Exception $e)
        {
            var_dump($e->getMessage());
        }
    }

    public function login($dataUsername, $dataPassword)
    {
        $query = "SELECT id, nome, senha, username, admin FROM usuarios WHERE username = '$dataUsername' AND senha = '$dataPassword';";

        $result = $this->conn->prepare($query);

        if ($result->execute())
        {            
            $user = $result->fetchObject();
            if($user)
            {                                        
                return $user;                
            }
            else
            {
                http_response_code(403);
                throw new Exception("Usuário não encontrado");
            }   
        }        
        return false;
    }    
}

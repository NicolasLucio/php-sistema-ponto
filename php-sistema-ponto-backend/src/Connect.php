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

    public function add($dataUserID)
    {
        $localUserID = $dataUserID->userID;
        $queryCheck = "SELECT id FROM usuarios WHERE id= '$localUserID';";
        $queryResult = $this->conn->prepare($queryCheck);
        $queryResult->execute();
        $resultQuery = $queryResult->fetchAll(PDO::FETCH_ASSOC);

        if (count($resultQuery) > 0)
        {
            date_default_timezone_set('America/Sao_Paulo');
            $actualDate = date('d-m');

            $quantityCheck = "SELECT id FROM pontos WHERE userID = $localUserID AND data = '$actualDate';";
            $quantityResult = $this->conn->prepare($quantityCheck);
            $quantityResult->execute();
            $result = $quantityResult->fetchAll(PDO::FETCH_ASSOC);      

            if (count($result) <= 4)
            {                
                $actualTimeHour = date('H');
                $actualTimeMinute = date('i');
                $query = "INSERT INTO pontos (id, userID, data, hora, minuto) VALUES(null, $localUserID, '$actualDate', '$actualTimeHour', '$actualTimeMinute');";

                try
                {                
                    $this->conn->exec($query);
                    $resultContext = "Dia: " . $actualDate . " - Horario: ". $actualTimeHour . ":" . $actualTimeMinute;
                    return $resultContext;
                }
                catch(Exception $e)
                {
                    var_dump($e->getMessage());
                }   
            }
            else
            {
                var_dump("Quantidade = " . count($result));
                return false;
                // Muito Usuario
            }                     
        }
        else
        {
            var_dump("User not Found");
        }
    }
}

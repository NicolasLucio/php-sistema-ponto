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
            throw new Exception($e->getMessage());
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
                throw new Exception("Senha e/ou Usuário Incorreto");
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

            if (count($result) <= 3)
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
                    throw new Exception($e->getMessage());
                }   
            }
            else
            {
                throw new Exception("Quantidade = " . count($result));
                return false;                
            }                     
        }
        else
        {
            throw new Exception("Usuario não Encontrado");
        }
    }

    public function history($dataUserID)
    {
        $localUserID = $dataUserID->userID;
        $queryCheck = "SELECT data, hora, minuto FROM pontos WHERE userID = '$localUserID' ORDER BY id DESC LIMIT 10;";
        $queryResult = $this->conn->prepare($queryCheck);
        $queryResult->execute();
        $resultQuery = $queryResult->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultQuery;
    }

    public function adminList()
    {
        $queryCheck = "SELECT id, nome, username FROM usuarios";
        $queryResult = $this->conn->prepare($queryCheck);
        $queryResult->execute();
        $resultQuery = $queryResult->fetchAll(PDO::FETCH_ASSOC);

        return $resultQuery;
    }

    public function adminCreate($userData)
    {
        $query = "SELECT id FROM usuarios WHERE username = '$userData->username';";

        $result = $this->conn->prepare($query);

        if ($result->execute())
        {
            $user = $result->fetchObject();
            if ($user)
            {
                throw new Exception("Username já em uso");
            }
            else
            {                
                if ($userData->checkbox)
                {
                    $localAdmin = 1;
                }
                else
                {
                    $localAdmin = 0;
                }

                $userData->checkbox = $localAdmin;
                
                //$userData->nome = filter_input(INPUT_POST, "nome", FILTER_DEFAULT);
                //$userData->username = filter_input(INPUT_POST, "username", FILTER_DEFAULT);
                //$userData->password = filter_input(INPUT_POST, "password", FILTER_DEFAULT);            
                
                $error = [];
        
                if (is_null($userData->nome) || strlen($userData->nome) <1)
                {
                    $erro[] = "Campo Nome Inválido";
                }
                if (is_null($userData->username) || strlen($userData->username) < 1)
                {
                    $error[] = "Campo Username Inválido";
                }
        
                if (is_null($userData->password) || strlen($userData->password) < 1)
                {
                    $error[] = "Campo Senha Inválido";
                }
        
                if ($erro != null)
                {
                    if (count($erro) > 0)
                    {
                        throw new Exception(implode(" - ", $erro));
                        return false;
                    }
                }                
                else
                {
                    return $userData;
                }  
            }
        }
    }   
}

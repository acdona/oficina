<?php
namespace App\adms\Models\helper;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

use PDO;
use Exception;

/**
 * AdmsConn helper responsible for connection to the database.
 *
 * @author ACD
 */
abstract class AdmsConn
{

    /** @var string $host Receives the host of the constant HOST */
    private string $host = HOST;
    /** @var string $user Receives the user of the constant USER */
    private string $user = USER;
    /** @var string $pass Receives the password of the constant PASS */
    private string $pass = PASS;
    /** @var string $dbName Receives the database of the constant DBNAME */
    private string $dbName = DBNAME;
    /** @var int $port Receives the port of the constant PORT */
    private int $port = PORT;
    /** @var object $connect Receives the conection to the database */
    private object $connect;

    /**
     * Performs the connection to the database.
     * @return object Returns the connection to the database.
     */
    protected function connect(): object {
        try {
            $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=" . $this->dbName, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $this->connect;
        } catch (Exception $ex) {
            die('Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador ' . EMAILADM . '<br>');
            
            $urlDestiny = URLADM . "error/index";
            header("Location: $urlDestiny");
        }
    }

}

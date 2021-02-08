<?php
namespace App\sts\Models\helper;

use Exception;
use PDO;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * helper StsConn responsável pela conexão com o banco de dados
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access private 
 *
*/
abstract class StsConn
{
    /** @var string $host Recebe o host da constante HOST */
    private string $host = HOST;
    /** @var string $user Recebe o host da constante USER */
    private string $user = USER;
    /** @var string $pass Recebe o host da constante PASS */
    private string $pass = PASS;
    /** @var string $dbname Recebe o host da constante DBNAME */
    private string $dbName = DBNAME;
    /** @var int $port Recebe o host da constante PORT */
    private int $port = PORT;
    /** @var object $connect Recebe a conexão com o banco de dados */
    private object $connect;
 
    /**
     * Realiza a conexão com o banco de dados.
     * @return object Retorna a conexão com o banco de dados
     */
    
    public function connect() {
        try {
            $this->connect = new PDO("mysql:host={$this->host};port={$this->port};dbname=" .
            $this->dbName, $this->user, $this->pass , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $this->connect;
        } catch (Exception $ex) {
            die('Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador ' . EMAILADM . '<br>');
        }
    }

}

?>

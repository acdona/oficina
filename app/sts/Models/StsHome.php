<?php
namespace App\sts\Models;

if (!defined('48b5t9')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Model StsHome responsável por listar dados da página home
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsHome
{

    private object $connection;

    public function index(){
        $connection = new \App\sts\Models\helper\StsConn();
        $this->connection = $connection->connect();
        var_dump($this->connection);
        echo "Models: Listar dados das página home!<br>";
    }

}

?>
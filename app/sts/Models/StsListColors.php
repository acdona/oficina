<?php
namespace App\sts\Models;

/**
 * Model StsListColors responsável por listar as cores
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsListColors
{

    /** @var array $resultDb Recebe o resultado do banco de dados */
    private array $resultDb;

    /** @var bool $result Retorna se consulta ao banco de dados funcionou */
    private bool $result;

    function getResult(): bool {
        return $this->result;
    }

    function getResultDb() {
        return $this->resultDb;
    }

    public function ListColors() {
        $ListColors  = new \App\sts\Models\helper\StsRead();
        $ListColors->fullRead("SELECT id, name, color FROM sts_colors");

        $this->resultDb = $ListColors->getResult();
        if($this->resultDb) {
            $this->result = true;
        }else{
            $_SESSION['msg'] = "Nenhuma cor encontrada!<br>";
            $this->result = false;
        }    
    }

}

?>
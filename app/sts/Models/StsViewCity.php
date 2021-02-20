<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * StsViewCity Model responsible for viewing a category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsViewCity
{

    private array $resultadoBd;
    private bool $resultado;
    private int $id;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function viewCity($id) {
        $this->id = (int) $id;
        $viewCity = new \App\sts\Models\helper\StsRead();
        $viewCity->fullRead("SELECT id, code, name, fs
                FROM sts_cities 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->resultadoBd = $viewCity->getResult();
 
        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Cidade não encontrada!</div>";
            $this->resultado = false;
        }
    }

}

?>
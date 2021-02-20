<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * StsViewCategory Model responsible for viewing a category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsViewCategory
{

    private $resultadoBd;
    private bool $resultado;
    private int $id;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    function getResultadoBd() {
        return $this->resultadoBd;
    }

    public function viewCategory($id) {
        $this->id = (int) $id;
        $viewCategory = new \App\sts\Models\helper\StsRead();
        $viewCategory->fullRead("SELECT id, name
                FROM sts_categories 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->resultadoBd = $viewCategory->getResult();

        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada!</div>";
            $this->resultado = false;
        }
    }

}

?>
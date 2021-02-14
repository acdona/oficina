<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Models StsViewAccountCategory responsável por vizualializar a categoria das contas
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsViewAccountCategory
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

    public function viewAccountCategory($id) {
        $this->id = (int) $id;
        $viewAccountCategory = new \App\sts\Models\helper\StsRead();
        $viewAccountCategory->fullRead("SELECT id, name
                FROM sts_account_categories 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
                
        $this->resultadoBd = $viewAccountCategory->getResult();

        if($this->resultadoBd){
            $this->resultado = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Categoria não encontrada na models!</div>";
            $this->resultado = false;
        }
    }

}

?>
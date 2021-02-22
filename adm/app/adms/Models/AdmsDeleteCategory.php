<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AdmsDeleteCategory Model responsible for deleting a category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsDeleteCategory
{

    private bool $resultado;
    private int $id;
    private $resultadoBd;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    public function deleteCategory($id) {
        $this->id = (int) $id;
        /**Verifica se a Categoria existe E se algum produto está utilizando a mesma */
        if ($this->viewCategory() AND $this->checkUseCategory()) {
            $deleteCategory = new \App\adms\Models\helper\AdmsDelete();
            $deleteCategory->exeDelete("adms_categories", "WHERE id =:id", "id={$this->id}");

            if ($deleteCategory->getResult()) {
                $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Categoria apagada com sucesso!</div>";
                $this->resultado = true;
            } else {
                $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Categoria não apagada!</div>";
                $this->resultado = false;
            }
        } else {
            $this->resultado = false;
        }
    }

    /**Verifica se a Categoria existe */
    private function viewCategory() {
        $viewCategory = new \App\adms\Models\helper\AdmsRead();
        $viewCategory->fullRead("SELECT id FROM adms_categories 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewCategory->getResult();
        if ($this->resultadoBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Categoria não encontrada!</div>";
            return false;
        }
    }
    /** Verifica se alguma conta está utilizando a categoria a ser apagada */
    private function checkUseCategory() {
        $checkUseCategory = new \App\adms\Models\helper\AdmsRead();
        $checkUseCategory->fullRead("SELECT id FROM adms_products WHERE adms_category_id=:adms_category_id LIMIT :limit", "adms_category_id={$this->id}&limit=1");
        if($checkUseCategory->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: A categoria não pode ser apagada, ela está sendo usada por um produto!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>
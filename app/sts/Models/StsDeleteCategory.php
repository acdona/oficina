<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * StsDeleteCategory Model responsible for deleting a category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsDeleteCategory
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
            $deleteCategory = new \App\sts\Models\helper\StsDelete();
            $deleteCategory->exeDelete("sts_categories", "WHERE id =:id", "id={$this->id}");

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
        $viewCategory = new \App\sts\Models\helper\StsRead();
        $viewCategory->fullRead("SELECT id FROM sts_categories 
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
        $checkUseCategory = new \App\sts\Models\helper\StsRead();
        $checkUseCategory->fullRead("SELECT id FROM sts_products WHERE sts_category_id=:sts_category_id LIMIT :limit", "sts_category_id={$this->id}&limit=1");
        if($checkUseCategory->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: A categoria não pode ser apagada, ela está sendo usada por um produto!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>
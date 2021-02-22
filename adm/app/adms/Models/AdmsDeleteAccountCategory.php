<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AdmsDeleteAccountCategory Model responsible for deleting a account category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsDeleteAccountCategory
{

    private bool $resultado;
    private int $id;
    private $resultadoBd;

    function getResultado(): bool {
        return $this->resultado;
    }
    
    public function deleteAccountCategory($id) {
        $this->id = (int) $id;
        /**Verifica se a Categoria das Contas existe E se alguma conta está utilizando a mesma */
        if ($this->viewAccountCategory() AND $this->checkUseAccountCategory()) {
            $deleteAccountCategory = new \App\adms\Models\helper\AdmsDelete();
            $deleteAccountCategory->exeDelete("adms_account_categories", "WHERE id =:id", "id={$this->id}");

            if ($deleteAccountCategory->getResult()) {
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

    /**Verifica se a Categoria das Contas existe */
    private function viewAccountCategory() {
        $viewAccountCategory = new \App\adms\Models\helper\AdmsRead();
        $viewAccountCategory->fullRead("SELECT id FROM adms_account_categories 
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultadoBd = $viewAccountCategory->getResult();
        if ($this->resultadoBd) {
            return true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Categoria não encontrada!</div>";
            return false;
        }
    }
    /** Verifica se alguma conta está utilizando a categoria a ser apagada */
    private function checkUseAccountCategory() {
        $checkUseAccountCategory = new \App\adms\Models\helper\AdmsRead();
        $checkUseAccountCategory->fullRead("SELECT id FROM adms_accounts WHERE adms_account_category_id=:adms_account_category_id LIMIT :limit", "adms_account_category_id={$this->id}&limit=1");
        if($checkUseAccountCategory->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: A categoria não pode ser apagada, ela está sendo usada por uma conta!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>
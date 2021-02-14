<?php
namespace App\sts\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Models StsDeleteAccountCategory responsável por deletar categoria das contas
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class StsDeleteAccountCategory
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
            $deleteAccountCategory = new \App\sts\Models\helper\StsDelete();
            $deleteAccountCategory->exeDelete("sts_account_categories", "WHERE id =:id", "id={$this->id}");

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
        $viewAccountCategory = new \App\sts\Models\helper\StsRead();
        $viewAccountCategory->fullRead("SELECT id FROM sts_account_categories 
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
        $checkUseAccountCategory = new \App\sts\Models\helper\StsRead();
        $checkUseAccountCategory->fullRead("SELECT id FROM sts_accounts WHERE sts_account_category_id=:sts_account_category_id LIMIT :limit", "sts_account_category_id={$this->id}&limit=1");
        if($checkUseAccountCategory->getResult()){
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: A categoria de contas não pode ser apagada, há situação de conta utilizando essa categoria!</div>";
            return false;
        }else{
            return true;
        }
    }

}

?>
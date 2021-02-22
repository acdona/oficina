<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * DeleteAccountCategory Controller responsible for deleting an account category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DeleteAccountCategory
{
    /** @var int $id Recebe im inteiro referente ao ID da categoria das contas */
    private int $id;

    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteAccountCategory = new \App\adms\Models\AdmsDeleteAccountCategory();
            $deleteAccountCategory->deleteAccountCategory($this->id);
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar uma categoria!</div>";
        }
        
        $urlDestino = URL . "list-account-category/index";
        header("Location: $urlDestino");
    }

}

?>
<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller DeleteAccountCategory responsável por deletar categoria das contas
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
            $deleteAccountCategory = new \App\sts\Models\StsDeleteAccountCategory();
            $deleteAccountCategory->deleteAccountCategory($this->id);
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar uma categoria!</div>";
        }
        
        $urlDestino = URL . "list-account-category/index";
        header("Location: $urlDestino");
    }

}

?>
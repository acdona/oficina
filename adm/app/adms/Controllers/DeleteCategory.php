<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 *  DeleteCategory Controller responsible for deleting a category
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DeleteCategory
{
    /** @var int $id Recebe um inteiro referente ao  ID da categoria. */
    private int $id;

    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteCategory = new \App\sts\Models\StsDeleteCategory();
            $deleteCategory->deleteCategory($this->id);
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar uma categoria!</div>";
        }
        
        $urlDestino = URL . "list-category/index";
        header("Location: $urlDestino");
    }

}

?>
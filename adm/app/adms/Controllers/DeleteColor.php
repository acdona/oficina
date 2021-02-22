<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * DeleteColor Controller responsible for deleting a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DeleteColor
{
    /** @var int $id Recebe um inteiro referente ao  ID da categoria. */
    private int $id;

    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteColor = new \App\adms\Models\AdmsDeleteColor();
            $deleteColor->deleteColor($this->id);
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar uma cor!</div>";
        }
        
        $urlDestino = URL . "list-colors/index";
        header("Location: $urlDestino");
    }

}

?>
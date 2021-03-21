<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * DeleteAccessLevel Controller. Responsible for deleting a access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DeleteAccessLevel
{
    /** @var int $id Receive an integer reffering the access level ID. */
    private int $id;

    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteAccessLevel = new \App\adms\Models\AdmsDeleteAccessLevel();
            $deleteAccessLevel->deleteAccessLevel($this->id);
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Necessário selecionar um nível de acesso!</div>";
        }
        
        $urlRedirect = URLADM . "list-access-levels/index";
        header("Location: $urlRedirect");
    }

}

?>
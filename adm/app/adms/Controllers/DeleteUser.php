<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * DeleteUser Control. Responsible for deleting the user. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DeleteUser
{

    private $id;

    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteUser = new \App\adms\Models\AdmsDeleteUser();
            $deleteUser->deleteUser($this->id);
        }else{
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Necessário selecionar um usuário!</div>";
            
        }
        
        $urlDestiny = URLADM . "list-users/index";
        header("Location: $urlDestiny");
    }


}

?>
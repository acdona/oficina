<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe DeleteUser responsável por 
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
            $deleteUser = new \App\sts\Models\StsDeleteUser();
            $deleteUser->deleteUser($this->id);
        }else{
            $_SESSION['msg'] = "Erro: Necessário selecionar um usuário!";
        }
        
        $urlDestino = URLADM . "list-users/index";
        header("Location: $urlDestino");
    }


}

?>
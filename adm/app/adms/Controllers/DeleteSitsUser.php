<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe DeleteSitsUser responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DeleteSitsUser
{

    private $id;

    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteSitsUser = new \App\adms\Models\AdmsDeleteSitsUser();
            $deleteSitsUser->deleteSitsUser($this->id);
        }else{
            $_SESSION['msg'] = "Erro: Necessário selecionar uma situação para usuário!";
        }
        
        $urlDestino = URLADM . "list-sits-users/index";
        header("Location: $urlDestino");
    }

}

?>
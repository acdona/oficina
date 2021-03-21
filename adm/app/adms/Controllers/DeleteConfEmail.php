<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * DeleteConfEmail Controller. Responsible for deleting email configuration. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class DeleteConfEmail
{

    private $id;

    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteConfEmail = new \App\adms\Models\AdmsDeleteConfEmail();
            $deleteConfEmail->deleteConfEmail($this->id);
        }else{
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Necessário selecionar um E-mail!</div>";
            
        }
        
        $urlRedirect = URLADM . "list-conf-emails/index";
        header("Location: $urlRedirect");
    }


}

?>
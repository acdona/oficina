<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * ConfEmail Controller. Responsible for confirming the user's email.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ConfEmail
{

    private $key;

    public function index() {
        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);
       
        if(!empty($this->key)) {
            $this->validateKey();
        }else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Link inválido!</div>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

    private function validateKey() {
        
        $confEmail = new \App\adms\Models\AdmsConfEmail();
        $confEmail->confEmail($this->key);
        if($confEmail->getResult()) {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        } else {
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }

    }

}

?>
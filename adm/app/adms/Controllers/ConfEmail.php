<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * Classe ConfEmail responsável por 
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

    private $chave;

    public function index() {
        $this->chave = filter_input(INPUT_GET, "chave", FILTER_DEFAULT);
       
        if(!empty($this->chave)) {
            $this->validarChave();
        }else {
            $_SESSION['msg'] = "Erro: Link inválido!<br>";
            $urlDestino = URLADM . "login/index";
            header("Location: $urlDestino");
        }
    }

    private function validarChave() {
        $confEmail = new \App\adms\Models\AdmsConfEmail();
        $confEmail->confEmail($this->chave);
        if($confEmail->getResultado()) {
            $urlDestino = URLADM . "login/index";
            header("Location: $urlDestino");
        } else {
            $urlDestino = URLADM . "login/index";
            header("Location: $urlDestino");
        }

    }

}

?>
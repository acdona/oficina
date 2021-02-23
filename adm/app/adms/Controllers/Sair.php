<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe Sair responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class Sair
{

    public function index() {
        unset($_SESSION['user_id'], $_SESSION['user_nome'], $_SESSION['user_email']);
        
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Deslogado com sucesso!</div>';
        $urlDestino = URLADM . 'login/index';
        header("Location: $urlDestino");
    }

}

?>
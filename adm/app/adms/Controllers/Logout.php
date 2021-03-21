<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Logout Control Responsible for logging out user. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class Logout
{

    public function index() {
        unset($_SESSION['user_id'], 
              $_SESSION['user_name'], 
              $_SESSION['user_email'],
              $_SESSION['user_nickname'], 
              $_SESSION['user_image']);
        
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Deslogado com sucesso!</div>';
        $urlRedirect = URLADM . 'login/index';
        header("Location: $urlRedirect");
    }

}

?>
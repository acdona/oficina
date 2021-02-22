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
        unset($_SESSION['usuario_id'], $_SESSION['usuario_nome'], $_SESSION['usuario_email']);
        
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Deslogado com sucesso!</div>';
        $urlDestino = URLADM . 'login';
        header("Location: $urlDestino");
    }

}

?>
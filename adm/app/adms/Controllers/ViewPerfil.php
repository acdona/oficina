<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * Classe ViewPerfil responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ViewPerfil
{

    private $dados;

    public function index() {
       $viewPerfil = new \App\adms\Models\AdmsViewPerfil();
       $viewPerfil->viewPerfil();
        if($viewPerfil->getResultado()) {
            $this->dados['perfil'] = $viewPerfil->getResultadoBd();
            $this->viewPerfil();
        } else {
            $urlDestino = URLADM . "login/index";
            header("Location: $urlDestino");

        }
    }

    private function viewPerfil() {
        $carregarView= new \App\adms\core\ConfigView("adms/Views/user/viewPerfil", $this->dados);
        $carregarView->renderizar();

    }

}

?>
<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe ViewPgHome responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ViewPgHome
{

    private $dados;
    
    public function index() {
        $viewHome = new \App\adms\Models\AdmsViewHome();
        $this->dados['home'] = $viewHome->viewHome();
        
        $carregarView = new \Core\ConfigView("adms/Views/pgHome/viewPgHome", $this->dados);
        $carregarView->renderizar();
    }

}

?>
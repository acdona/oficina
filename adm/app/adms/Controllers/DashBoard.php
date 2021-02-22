<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe DashBoard responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DashBoard
{

    public function index() {
        $carregarView= new \Core\ConfigView("adms/Views/dashboard/home");
        $carregarView->renderizar();
    }

}

?>
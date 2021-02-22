<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * Classe Home responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class Home
{

    public function index() {
        $carregarView = new \Core\ConfigView("adms/Views/home/home");
        $carregarView->renderizar();
    }

}

?>
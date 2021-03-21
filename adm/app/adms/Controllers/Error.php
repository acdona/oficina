<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Error controller Responsible for displaying the error page 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class Error
{

    private array $data;

    public function index()
    {
        
        $this->data = [];
        $viewError = new \App\adms\Models\AdmsError;
        $viewError->view();
        
        /** Load View Home */
        $loadView = new \Core\ConfigView("adms/Views/error/error", $this->data);
        $loadView->render();
    }

}

?>
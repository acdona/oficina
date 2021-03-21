<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 *  Home Controller responsible for loading the homepage 
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
    
    /** @var array $data Receives the data that must be sent to VIEW*/
    private array $data;

    /**
     * Instantiate MODELS and receive feedback
     * 
     * @ return void
     */
    public function index() : void {   
        $this->data = [];
         /** Load AdmsHome Models */   
        $home = new \App\adms\Models\AdmsHome();
        $home->index();

        /** Load View Home */
        $loadView = new \Core\ConfigView("adms/Views/home/home", $this->data);
        $loadView->render();

        


    }

}

?>
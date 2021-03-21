<?php

namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 *  ViewFormLevel Controller. Responsible for viewing the form level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ViewFormLevel
{

    private $data;

    public function index() {
        
        $viewFormLevel = new \App\adms\Models\AdmsViewFormLevel();
        $viewFormLevel->viewFormLevel();

        if ($viewFormLevel->getResult()) {
            $this->data['viewFormLevel'] = $viewFormLevel->getDatabaseResult();
            $this->viewFormLevel();
        
        } else {
           
            $urlDestiny = URLADM . "dashboard/index";
            header("Location: $urlDestiny");
        }
    }

    private function viewFormLevel() {
        
        $this->data['sidebarActive'] = "view-form-level";
        $loadView = new \Core\ConfigView("adms/Views/formLevels/viewFormLevel", $this->data);
        $loadView->render();
    }

}

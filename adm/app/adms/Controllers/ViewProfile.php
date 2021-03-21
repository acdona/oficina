<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * ViewProfile Controller. Responsible for viewing the user's profile.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ViewProfile
{

    private $data;

    public function index() {
       $viewProfile = new \App\adms\Models\AdmsViewProfile();
       $viewProfile->viewProfile();
        if($viewProfile->getResult()) {
            $this->data['profile'] = $viewProfile->getDatabaseResult();
            $this->viewProfile();
        } else {
            
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");

        }
    }

    private function viewProfile() {
        $this->data['sidebarActive'] = "view-profile";
        $loadView= new \Core\ConfigView("adms/Views/users/viewProfile", $this->data);
        $loadView->render();

    }

}

?>
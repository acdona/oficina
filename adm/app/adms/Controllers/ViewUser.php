<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ViewUser . Responsible for viewing the user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewUser
{

    private int $id;
    private $data;

    public function index($id) {
        
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewUser = new \App\adms\Models\AdmsViewUser();
            $viewUser->viewUser($this->id);
            if ($viewUser->getResult()) {
                $this->data['viewUser'] = $viewUser->getDatabaseResult();
                $this->viewUser();
            } else {
                $urlDestiny = URLADM . "list-users/index";
                header("Location: $urlDestiny");
            }
        } else {
           
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não encontrado</div>";
            $urlDestiny = URLADM . "list-users/index";
            header("Location: $urlDestiny");
        }
    }
    
    private function viewUser() {
        $this->data['sidebarActive'] = "list-users";
        $loadView = new \Core\ConfigView("adms/Views/users/viewUser", $this->data);
        $loadView->render();
    }

}

?>
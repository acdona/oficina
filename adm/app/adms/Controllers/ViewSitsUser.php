<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ViewSitsUser Controller. Responsible for viewing the user's situation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewSitsUser
{

    
    private int $id;
    private $data;

    public function index($id) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewSitsUser = new \App\adms\Models\AdmsViewSitsUser();
            $viewSitsUser->viewSitsUser($this->id);
            if ($viewSitsUser->getResult()) {
                $this->data['viewSitsUser'] = $viewSitsUser->getDatabaseResult();
                $this->viewSitsUser();
            } else {
                $urlRedirect = URLADM . "list-sits-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Situação para usuário não encontrada</div>";
            $urlRedirect = URLADM . "list-sits-users/index";
            header("Location: $urlRedirect");
        }
    }
    
    private function viewSitsUser() {
        $this->data['sidebarActive'] = "list-sits-users";
        $loadView = new \Core\ConfigView("adms/Views/sitsUser/viewSitsUser", $this->data);
        $loadView->render();
    }

}

?>
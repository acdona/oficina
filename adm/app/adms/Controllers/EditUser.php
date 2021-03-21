<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditUser Controller. Responsible for editing the user.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditUser
{
    private $data;
    private $dataForm;
    private $id;

    public function index($id) {
        $this->id = (int) $id;
        
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dataForm['EditUser']))) {
            $viewUser = new \App\adms\Models\AdmsEditUser();
            $viewUser->viewUser($this->id);
            if ($viewUser->getResult()) {
                $this->data['form'] = $viewUser->getDatabaseResult();
                $this->viewEditUser();
            } else {
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editUser();
        }
    }

    private function viewEditUser() {
          
        $listSelect = new \App\adms\Models\AdmsEditUser();
        $this->data['select'] = $listSelect->listSelect();        

        $this->data['sidebarActive'] = "list-users";
        
        $carregarView = new \Core\ConfigView("adms/Views/users/editUser", $this->data);
        $carregarView->render();
    }

    private function editUser() {
        if (!empty($this->dataForm['EditUser'])) {
            unset($this->dataForm['EditUser']);
            $editUser = new \App\adms\Models\AdmsEditUser();
            $editUser->update($this->dataForm);
            if ($editUser->getResult()) {
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->dataForm;
                $this->viewEditUser();
            }
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não encontrado!</div>";
            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
    }
    

}

?>
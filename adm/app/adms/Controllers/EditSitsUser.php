<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditSitsUser Controlles. Responsible for editing the user's situation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditSitsUser
{
    private $data;
    private $formData;
    private $id;

    public function index($id) {
        $this->id = (int) $id;
        
        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->formData['EditSitsUser']))) {
            $viewSitsUser = new \App\adms\Models\AdmsEditSitsUser();
            $viewSitsUser->viewSitsUser($this->id);
            if ($viewSitsUser->getResult()) {
                $this->data['form'] = $viewSitsUser->getDatabaseResult();
                $this->viewEditSitsUser();
            } else {
                $urlDestiny = URLADM . "list-sits-users/index";
                header("Location: $urlDestiny");
            }
        } else {
            $this->editSitsUser();
        }
    }

    private function viewEditSitsUser() {        
        
        $listSelect = new \App\adms\Models\AdmsEditSitsUser();
        $this->data['select'] = $listSelect->listSelect();       
        
        $this->data['sidebarActive'] = "list-sits-users";
        
        $carregarView = new \Core\ConfigView("adms/Views/sitsUser/editSitsUser", $this->data);
        $carregarView->render();
    }

    private function editSitsUser() {
        
        if (!empty($this->formData['EditSitsUser'])) {
            unset($this->formData['EditSitsUser']);
            $editSitsUser = new \App\adms\Models\AdmsEditSitsUser();
            $editSitsUser->update($this->formData);
            if ($editSitsUser->getResult()) {
                $urlDestiny = URLADM . "list-sits-users/index";
                header("Location: $urlDestiny");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditSitsUser();
            }
        } else {
       
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Situação para usuário não encontrada!</div>";
            $urlDestiny = URLADM . "list-sits-users/index";
            header("Location: $urlDestiny");
        }
    }

}

?>
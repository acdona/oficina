<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditUserImage Controller. Responsible for editing the user's image.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditUserImage
{

    private $data;
    private $formData;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->formData['EditUserImage']))) {
            $viewUser = new \App\adms\Models\AdmsEditUserImage();
            $viewUser->viewUser($this->id);
            if ($viewUser->getResult()) {
                $this->data['form'] = $viewUser->getDatabaseResult();
                $this->viewEditUserImage();
            } else {
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editUser();
        }
    }

    private function viewEditUserImage() {
        $this->data['sidebarActive'] = "list-users";
        $carregarView = new \Core\ConfigView("adms/Views/users/editUserImage", $this->data);
        $carregarView->render();
    }

    private function editUser() {
        if (!empty($this->formData['EditUserImage'])) {
            unset($this->formData['EditUserImage']);
            $this->formData['new_image'] = ($_FILES['new_image'] ? $_FILES['new_image'] : null);
            $editUser = new \App\adms\Models\AdmsEditUserImage();
            $editUser->update($this->formData);
            if ($editUser->getResult()) {
                $urlRedirect = URLADM . "view-user/index/" . $this->formData['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditUserImage();
            }
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não encontrado!</div>";
            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        }
    }


}

?>
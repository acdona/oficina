<?php
namespace App\adms\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditProfileImage Controller. Responsible for editing the profile image.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditProfileImage
{

    private $data;
    private $formData;

    public function index() {
        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->formData['EditProfileImage'])) {
            $this->EditProfileImage();
        } else {
            $viewProfile = new \App\adms\Models\AdmsEditProfileImage();
            $viewProfile->viewProfile();
            if ($viewProfile->getResult()) {
                $this->data['form'] = $viewProfile->getDatabaseResult();
                $this->viewEditProfileImage();
            } else {
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }
        }
    }

    private function viewEditProfileImage() {
        $this->data['sidebarActive'] = "view-profile";
        $loadView = new \Core\ConfigView("adms/Views/users/editProfileImage", $this->data);
        $loadView->render();
    }

    private function editProfileImage() {
        if (!empty($this->formData['EditProfileImage'])) {
            unset($this->formData['EditProfileImage']);
            $this->formData['new_image'] = ($_FILES['new_image'] ? $_FILES['new_image'] : null);
            $editProfile = new \App\adms\Models\AdmsEditProfileImage();
            $editProfile->update($this->formData);
            if ($editProfile->getResult()) {
                $urlRedirect = URLADM . "view-profile/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditProfileImage();
            }
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não encontrado!</div>";
            $urlRedirect = URLADM . "login/index";
            header("Location: $urlRedirect");
        }
    }

}

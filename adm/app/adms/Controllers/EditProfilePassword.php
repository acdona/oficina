<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * EditProfilePassword Controller. Responsible for editing the user profile password.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditProfilePassword
{

    private $formData;
    private $data;
 
    public function index()
    {
        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
        if(!empty($this->formData['EditProfilePass'])) {
            $this->editProfilePass();

        }else {
            $viewProfilePass = new \App\adms\Models\AdmsEditProfilePassword();
            $viewProfilePass->viewProfilePassword();
            if($viewProfilePass->getResult()) {
                $this->data['form'] = $viewProfilePass->getDatabaseResult();
                $this->viewEditProfilePass();
            }else {
                $urlDestiny = URLADM . "login/index";
                header("Location: $urlDestiny");
            }
        }

    }

    /**
     * viewEditProfile
     * Method responsible for loading the view.
     * 
     * @author ACD
     */
    private function viewEditProfilePass()
    {
        $this->data['sidebarActive'] = "view-profile";
        $loadView = new \Core\ConfigView("adms/Views/users/editProfilePassword", $this->data);
        $loadView->render();

    }

    private function editProfilePass(){
        if(!empty($this->formData['EditProfilePass'])) {
            unset($this->formData['EditProfilePass']);
            $editProfile = new \App\adms\Models\AdmsEditProfilePassword();
            $editProfile->update($this->formData);
            if($editProfile->getResult()) {
                $urlDestiny = URLADM . "view-profile/index";
                header("Location: $urlDestiny");
            }else {
                $this->data['form'] = $this->formData;
                $this->viewEditProfilePass();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado!</div>";
            $urlDestiny = URLADM . "login/index";
            header("Location: $urlDestiny");
        }
            
    }

}

?>
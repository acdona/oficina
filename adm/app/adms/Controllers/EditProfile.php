<?php

namespace App\adms\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditProfile Controller. Responsible for editing the user profile.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditProfile
{
    private $formData;
    private $data;
    
    public function index() {
        
        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->formData['EditProfile'])){
            $this->editProfile();
        }else{
            $viewProfile = new \App\adms\Models\AdmsEditProfile();
            $viewProfile->viewProfile();
            if($viewProfile->getResult()){
                $this->data['form'] = $viewProfile->getDatabaseResult();
                $this->viewEditProfile();
            }else{
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
                       
            }
        }        
    }
    
    private function viewEditProfile() {
        $this->data['sidebarActive'] = "view-profile";
        $loadView= new \Core\ConfigView("adms/Views/users/editProfile", $this->data);
        $loadView->render();
    }
    
    private function editProfile() {
        if(!empty($this->formData['EditProfile'])){
            unset($this->formData['EditProfile']);
            $editProfile = new \App\adms\Models\AdmsEditProfile();
            $editProfile->update($this->formData);
            if($editProfile->getResult()){
                $urlRedirect = URLADM . "view-profile/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->formData;
                $this->viewEditProfile();
            }
        }else{
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não encontrado!</div>";
            $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
        }
    }
}

<?php
namespace App\adms\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditFormLevel Controller. Responsible for editing the form level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditFormLevel
{

    private $data;
    private $formData;

    public function index() {

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (empty($this->formData['EditFormLevel'])) {
            $viewFormLevel = new \App\adms\Models\AdmsEditFormLevel();
            $viewFormLevel->viewFormLevel();
            if ($viewFormLevel->getResult()) {
                $this->data['form'] = $viewFormLevel->getDatabaseResult();
                $this->viewEditFormLevel();
            } else {
                $urlDestiny = URLADM . "view-form-level/index";
                header("Location: $urlDestiny");
            }
        } else {
            $this->editFormLevel();
        }
    }

    private function viewEditFormLevel() {
       
        $listSelect = new \App\adms\Models\AdmsEditFormLevel();
        $this->data['select'] = $listSelect->listSelect();        
       
        $this->data['sidebarActive'] = "view-form-level";
        
        $loadView = new \Core\ConfigView("adms/Views/formLevels/editFormLevel", $this->data);
        $loadView->render();
    }

    private function editFormLevel() {
        
        if (!empty($this->formData['EditFormLevel'])) {
            unset($this->formData['EditFormLevel']);
            $editFormLevel = new \App\adms\Models\AdmsEditFormLevel();
            $editFormLevel->update($this->formData);
            if ($editFormLevel->getResult()) {
                $urlDestiny = URLADM . "view-form-level/index";
                header("Location: $urlDestiny");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditFormLevel();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso, para formulário novo usuário, não encontrado!</div>";
            $urlDestiny = URLADM . "view-form-level/index";
            header("Location: $urlDestiny");
        }
    }
}
<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditUserPassword Controller. Responsible for editing the user's password.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditUserPassword
{

    private $data;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->id) AND (empty($this->formData['EditUserPass']))) {
            $viewUserPass = new \App\adms\Models\AdmsEditUsersPassword();
            $viewUserPass->viewUser($this->id);
            if ($viewUserPass->getResult()) {
                $this->data['form'] = $viewUserPass->getDatabaseResult();
                $this->viewEditUserPass();
            } else {
                $urlDestiny = URLADM . "list-users/index";
                header("Location: $urlDestiny");
            }
        } else {
            $this->EditUserPass();
        
        }
    }
    
    private function viewEditUserPass() {
        $this->data['sidebarActive'] = "list-users";
        $carregarView = new \Core\ConfigView("adms/Views/users/editUserPassword", $this->data);
        $carregarView->render();
    }

    private function EditUserPass() {
        if(!empty($this->formData['EditUserPass'])) {
            unset($this->formData['EditUserPass']);
            $editUserPass = new \App\adms\Models\AdmsEditUsersPassword();
            $editUserPass->update($this->formData);
            if($editUserPass->getResult()) {
                $urlDestiny = URLADM . "list-users/index";
                header("Location: $urlDestiny");
            }else {
                $this->data['form'] = $this->formData;
                $this->viewEditUserPass();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: Usuário não encontrado!</div>";
            $urlDestiny = URLADM . "list-users/index";
            header("Location: $urlDestiny");
        }
    }


}

?>
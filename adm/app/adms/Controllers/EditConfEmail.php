<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * EditConfEmail Controller. Responsible for editing email confirmation.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditConfEmail
{

    private $data;
    private $formData;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->formData['EditConfEmail']))) {
            $viewConfEmail = new \App\adms\Models\AdmsEditConfEmail();
            $viewConfEmail->viewConfEmail($this->id);
            if ($viewConfEmail->getResult()) {
                $this->data['form'] = $viewConfEmail->getDatabaseResult();
                $this->viewEditConfEmail();
            } else {
                $urlRedirect = URLADM . "list-conf-emails/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editConfEmail();
        }
    }

    private function viewEditConfEmail() {               
        $this->data['sidebarActive'] = "list-conf-emails";
        $loadView = new \Core\ConfigView("adms/Views/confEmails/editConfEmail", $this->data);
        $loadView->render();
    }

    private function editConfEmail() {
        if (!empty($this->formData['EditConfEmail'])) {
            unset($this->formData['EditConfEmail']);
            $editConfEmail = new \App\adms\Models\AdmsEditConfEmail();
            $editConfEmail->update($this->formData);
            if ($editConfEmail->getResult()) {
                $urlRedirect = URLADM . "view-conf-email/index/" . $this->formData['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditConfEmail();
            }
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>E-mail não encontrado!</div>";
            $urlRedirect = URLADM . "list-conf-emails/index";
            header("Location: $urlRedirect");
        }
    }


}

?>
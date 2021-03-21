<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditConfEmailPassword Controller. Responsible for setting the email password.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditConfEmailPassword
{

    private $data;
    private $formData;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->formData['EditConfEmailPass']))) {
            $viewConfEmailPass = new \App\adms\Models\AdmsEditConfEmailPass();
            $viewConfEmailPass->viewConfEmailPass($this->id);
            if ($viewConfEmailPass->getResult()) {
                $this->data['form'] = $viewConfEmailPass->getDatabaseResult();
                $this->viewEditConfEmailPass();
            } else {
                $urlRedirect = URLADM . "list-conf-emails-password/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editConfEmailPass();
        }
    }

    private function viewEditConfEmailPass() {               
        $this->data['sidebarActive'] = "list-conf-emails";
        $carregarView = new \Core\ConfigView("adms/Views/confEmails/editConfEmailPass", $this->data);
        $carregarView->render();
    }

    private function editConfEmailPass() {
        if (!empty($this->formData['EditConfEmailPass'])) {
            unset($this->formData['EditConfEmailPass']);
            $editConfEmailPass = new \App\adms\Models\AdmsEditConfEmailPass();
            $editConfEmailPass->update($this->formData);
            if ($editConfEmailPass->getResult()) {
                $urlRedirect = URLADM . "view-conf-email/index/" . $this->formData['id'];
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditConfEmailPass();
            }
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: E-mail não encontrado!</div>";
            $urlRedirect = URLADM . "list-conf-emails/index";
            header("Location: $urlRedirect");
        }
    }

}

?>
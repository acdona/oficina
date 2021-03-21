<?php

namespace App\adms\Controllers;

if(!defined('R4F5CC')){
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AddConfEmail Controller. Responsible for adding email configuration.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AddConfEmail
{

    private $data;
    private $formData;

    public function index() {

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->formData['AddConfEmail'])) {
            unset($this->formData['AddConfEmail']);
            $addConfEmail = new \App\adms\Models\AdmsAddConfEmail();
            $addConfEmail->create($this->formData);
            if ($addConfEmail->getResult()) {
                $urlRedirect = URLADM . "list-conf-emails/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewAddConfEmail();
            }
        } else {
            $this->viewAddConfEmail();
        }
    }

    private function viewAddConfEmail() {
        $this->data['sidebarActive'] = "list-conf-emails";
        $carregarView = new \Core\ConfigView("adms/Views/confEmails/addConfEmail", $this->data);
        $carregarView->render();
    }

}

<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * Classe EditConfEmailsPassword responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditConfEmailsPassword
{

    private $dados;
    private $dadosForm;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditConfEmailsPass']))) {
            $viewConfEmailsPass = new \App\adms\Models\AdmsEditConfEmailsPass();
            $viewConfEmailsPass->viewConfEmailsPass($this->id);
            if ($viewConfEmailsPass->getResultado()) {
                $this->dados['form'] = $viewConfEmailsPass->getResultadoBd();
                $this->viewEditConfEmailsPass();
            } else {
                $urlDestino = URLADM . "list-conf-emails-password/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editConfEmailsPass();
        }
    }

    private function viewEditConfEmailsPass() {               
        
        $carregarView = new \App\adms\core\ConfigView("adms/Views/confEmails/editConfEmailsPass", $this->dados);
        $carregarView->renderizar();
    }

    private function editConfEmailsPass() {
        if (!empty($this->dadosForm['EditConfEmailsPass'])) {
            unset($this->dadosForm['EditConfEmailsPass']);
            $editConfEmailsPass = new \App\adms\Models\AdmsEditConfEmailsPass();
            $editConfEmailsPass->update($this->dadosForm);
            if ($editConfEmailsPass->getResultado()) {
                $urlDestino = URLADM . "view-conf-emails/index/" . $this->dadosForm['id'];
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditConfEmailsPass();
            }
        } else {
            $_SESSION['msg'] = "E-mail não encontrado!<br>";
            $urlDestino = URLADM . "list-conf-emails/index";
            header("Location: $urlDestino");
        }
    }

}

?>
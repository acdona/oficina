<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * ViewConfEmail Controller. Responsible for viewing the email configuration.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ViewConfEmail
{

    private int $id;
    private $data;

    public function index($id) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewConfEmail = new \App\adms\Models\AdmsViewConfEmail();
            $viewConfEmail->viewConfEmail($this->id);
            if ($viewConfEmail->getResult()) {
                $this->data['viewConfEmail'] = $viewConfEmail->getDatabaseResult();
                $this->viewConfEmail();
            } else {
                $urlRedirect = URLADM . "list-conf-email/index";
                header("Location: $urlRedirect");
            }
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-warning' role='alert'>Erro: E-mail não encontrado</div>";
            $urlRedirect = URLADM . "list-conf-email/index";
            header("Location: $urlRedirect");
        }
    }
    
    private function viewConfEmail() {
        $loadView = new \Core\ConfigView("adms/Views/confEmails/viewConfEmail", $this->data);
        $loadView->render();
    }

}

?>
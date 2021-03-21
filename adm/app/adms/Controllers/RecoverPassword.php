<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * RecoverPassword Controller. Responsible for recovering the user's password.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class RecoverPassword
{

    private $data;
    private $formData;

    public function index() {

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->formData['RecoverPassword'])) {
            unset($this->formData['RecoverPassword']);
            $recoverPassword= new \App\adms\Models\AdmsRecoverPassword();
            $recoverPassword->recoverPassword($this->formData);
            if($recoverPassword->getResult()){
                $urlRedirect = URLADM . "login/index";
                header("Location: $urlRedirect");
            }else{
                $this->data['form'] = $this->formData;
                $this->viewRecoverPass();
            }            
        }else{
            $this->viewRecoverPass();
        }
    }
    
    private function viewRecoverPass() {
        $carregarView = new \Core\ConfigView("adms/Views/login/recoverPassword", $this->data);
        $carregarView->renderLogin();
    }


}

?>
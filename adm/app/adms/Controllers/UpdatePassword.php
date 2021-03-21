<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * UpdatePassword Controller. Responsible por receiving the password link.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class UpdatePassword
{

    private $key;
    private $formData;
   

    public function index() {
     
        $this->key = filter_input(INPUT_GET, "key", FILTER_DEFAULT);
        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->key) AND empty($this->formData['UpPassword'])) {
            $this->validateKey();
        } else {
            $this->updatePassword();
        }
    }

    private function validateKey() {
        $valkey = new \App\adms\Models\AdmsUpdatePassword();
        $valkey->validateKey($this->key);

        if($valkey->getResult()) {
          $this->viewUpdatePassword();
        } else {
            $urlDestiny = URLADM . "login/index";
            header("Location: $urlDestiny");
        }
    }

    private function updatePassword(){
        if(!empty($this->formData['UpPassword'])){
            unset($this->formData['UpPassword']);
            $this->formData['key'] = $this->key;
            $upPassword = new \App\adms\Models\AdmsUpdatePassword();
            $upPassword->editPassword($this->formData);
            if($upPassword->getResult()){
                $urlDestiny = URLADM . "login/index";
                header("Location: $urlDestiny");
            }else {
                $this->viewUpdatePassword();
            }

        }else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Link inválido, solicite novo link <a href='" . URLADM . "recover-password/index'>clique aqui</a>!</div>";
            $urlDestiny = URLADM . "login/index";
            header("Location: $urlDestiny");
        }
    }

    private function viewUpdatePassword() {
        $loadView = new \Core\ConfigView("adms/Views/login/updatePassword");
        $loadView->renderLogin();
    }

}

?>
<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe EditUsersPassword responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditUsersPassword
{

    private $dados;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($this->id) AND (empty($this->dadosForm['EditUserPass']))) {
            $viewUserPass = new \App\adms\Models\AdmsEditUsersPassword();
            $viewUserPass->viewUser($this->id);
            if ($viewUserPass->getResultado()) {
                $this->dados['form'] = $viewUserPass->getResultadoBd();
                $this->viewEditUserPass();
            } else {
                $urlDestino = URLADM . "list-users/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->EditUserPass();
        
        }
    }
    
    private function viewEditUserPass() {
        $carregarView = new \App\adms\core\ConfigView("adms/Views/user/editUserPassword", $this->dados);
        $carregarView->renderizar();
    }

    private function EditUserPass() {
        if(!empty($this->dadosForm['EditUserPass'])) {
            unset($this->dadosForm['EditUserPass']);
            $editUserPass = new \App\adms\Models\AdmsEditUsersPassword();
            $editUserPass->update($this->dadosForm);
            if($editUserPass->getResultado()) {
                $urlDestino = URLADM . "list-users/index";
                header("Location: $urlDestino");
            }else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditUserPass();
            }
        } else {
            $_SESSION['msg'] = "Usuário não encontrado!<br>";
            $urlDestino = URLADM . "list-users/index";
            header("Location: $urlDestino");
        }
    }


}

?>
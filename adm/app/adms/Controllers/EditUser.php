<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller EditUser responsável por editar o usuário
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditUser
{
    private $dados;
    private $dadosForm;
    private $id;

    public function index($id) {
        $this->id = (int) $id;
        
        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditUser']))) {
            $viewUser = new \App\sts\Models\StsEditUser();
            $viewUser->viewUser($this->id);
            if ($viewUser->getResultado()) {
                $this->dados['form'] = $viewUser->getResultadoBd();
                $this->viewEditUser();
            } else {
                $urlDestino = URLADM . "list-users/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editUser();
        }
    }

    private function viewEditUser() {
          
        $listSelect = new \App\sts\Models\StsEditUser();
        $this->dados['select'] = $listSelect->listSelect();        
        
        $carregarView = new \App\sts\core\ConfigView("sts/Views/user/editUser", $this->dados);
        $carregarView->renderizar();
    }

    private function editUser() {
        if (!empty($this->dadosForm['EditUser'])) {
            unset($this->dadosForm['EditUser']);
            $editUser = new \App\sts\Models\StsEditUser();
            $editUser->update($this->dadosForm);
            if ($editUser->getResultado()) {
                $urlDestino = URLADM . "list-users/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditUser();
            }
        } else {
            $_SESSION['msg'] = "Usuário não encontrado!<br>";
            $urlDestino = URLADM . "list-users/index";
            header("Location: $urlDestino");
        }
    }
    

}

?>
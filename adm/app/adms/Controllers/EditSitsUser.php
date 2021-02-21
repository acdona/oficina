<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Control EditSitsUser responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditSitsUser
{
    private $dados;
    private $dadosForm;
    private $id;

    public function index($id) {
        $this->id = (int) $id;
        
        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditSitsUser']))) {
            $viewSitsUser = new \App\sts\Models\StsEditSitsUser();
            $viewSitsUser->viewSitsUser($this->id);
            if ($viewSitsUser->getResultado()) {
                $this->dados['form'] = $viewSitsUser->getResultadoBd();
                $this->viewEditSitsUser();
            } else {
                $urlDestino = URLADM . "list-sits-user/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editSitsUser();
        }
    }

    private function viewEditSitsUser() {        
        
        $listSelect = new \App\sts\Models\StsEditSitsUser();
        $this->dados['select'] = $listSelect->listSelect();        
        
        $carregarView = new \App\sts\core\ConfigView("sts/Views/sitsUser/editSitsUser", $this->dados);
        $carregarView->renderizar();
    }

    private function editSitsUser() {
        
        if (!empty($this->dadosForm['EditSitsUser'])) {
            unset($this->dadosForm['EditSitsUser']);
            $editSitsUser = new \App\sts\Models\StsEditSitsUser();
            $editSitsUser->update($this->dadosForm);
            if ($editSitsUser->getResultado()) {
                $urlDestino = URLADM . "list-sits-users/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewEditSitsUser();
            }
        } else {
            $_SESSION['msg'] = "Situação para usuário não encontrado!<br>";
            $urlDestino = URLADM . "list-sits-user/index";
            header("Location: $urlDestino");
        }
    }

}

?>
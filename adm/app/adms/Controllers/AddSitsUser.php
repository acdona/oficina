<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AddSitsUser Controller responsible for adding an user situation. 
 * 
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 * 
 * @access public
 *
*/
class AddSitsUser
{
    private $dados;
    private $dadosForm;

    public function index() {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->dadosForm['AddSitsUser'])) {
            unset($this->dadosForm['AddSitsUser']);

            $addSitsUser = new \App\adms\Models\AdmsAddSitsUser();
            $addSitsUser->create($this->dadosForm);
            if ($addSitsUser->getResultado()) {
                $urlDestino = URLADM . "list-sits-users/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewAddSitsUser();
            }
        } else {
            $this->viewAddSitsUser();
        }
    }

    private function viewAddSitsUser() {
        $listSelect = new \App\adms\Models\AdmsAddSitsUser();
        $this->dados['select'] = $listSelect->listSelect();
        
        $this->dados['sidebarActive'] = "list-sits-users";

        $carregarView = new \App\adms\core\ConfigView("adms/Views/sitsUser/addSitsUser", $this->dados);
        $carregarView->renderizar();
    }

}

?>
<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AddSitsUser Controller. Responsible for adding an user situation. 
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
    private $data;
    private $formData;

    public function index() {

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->formData['AddSitsUser'])) {
            unset($this->formData['AddSitsUser']);

            $addSitsUser = new \App\adms\Models\AdmsAddSitsUser();
            $addSitsUser->create($this->formData);
            if ($addSitsUser->getResult()) {
                $urlDestiny = URLADM . "list-sits-users/index";
                header("Location: $urlDestiny");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewAddSitsUser();
            }
        } else {
            $this->viewAddSitsUser();
        }
    }

    private function viewAddSitsUser() {
        $listSelect = new \App\adms\Models\AdmsAddSitsUser();
        $this->data['select'] = $listSelect->listSelect();
        
        $this->data['sidebarActive'] = "list-sits-users";

        $carregarView = new \Core\ConfigView("adms/Views/sitsUser/addSitsUser", $this->data);
        $carregarView->render();
    }

}

?>
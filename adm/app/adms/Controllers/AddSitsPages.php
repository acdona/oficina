<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AddSitsPages Controller. Responsible for adding the situations of the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AddSitsPages
{

    private $data;
    private $formData;

    public function index() {

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->formData['AddSitsPages'])) {
            unset($this->formData['AddSitsPages']);
            $addSitsPages = new \App\adms\Models\AdmsAddSitsPages();
            $addSitsPages->create($this->formData);
            if ($addSitsPages->getResult()) {
                $urlRedirect = URLADM . "list-sits-pages/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewAddSitsPages();
            }
        } else {
            $this->viewAddSitsPages();
        }
    }

    private function viewAddSitsPages() {
        $listSelect = new \App\adms\Models\AdmsAddSitsPages();
        $this->data['select'] = $listSelect->listSelect();
        
        $this->data['sidebarActive'] = "list-sits-pages";

        $loadView = new \Core\ConfigView("adms/Views/sitsPages/addSitsPages", $this->data);
        $loadView->render();
    }

}

?>
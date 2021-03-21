<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AddPages Controller. Responsible for adding the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AddPages
{

    private $data;
    private $formData;

    public function index() {

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->formData['AddPages'])) {
            unset($this->formData['AddPages']);
            $addPages = new \App\adms\Models\AdmsAddPages();
            $addPages->create($this->formData);
            if ($addPages->getResult()) {
                $urlRedirect = URLADM . "list-pages/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewAddPages();
            }
        } else {
            $this->viewAddPages();
        }
    }

    private function viewAddPages() {
        $listSelect = new \App\adms\Models\AdmsAddPages();
        $this->data['select'] = $listSelect->listSelect();
        
        $this->data['sidebarActive'] = "list-pages";

        $loadView = new \Core\ConfigView("adms/Views/pages/addPages", $this->data);
        $loadView->render();
    }


}

?>
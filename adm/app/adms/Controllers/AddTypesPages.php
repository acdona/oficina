<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AddTypesPages Controller. Responsible for adding the types of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AddTypesPages
{

    private $data;
    private $formData;

    public function index() {
        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->formData['AddTypesPages'])) {
            unset($this->formData['AddTypesPages']);
            $addTypesPages = new \App\adms\Models\AdmsAddTypesPages();
            $addTypesPages->create($this->formData);
            if ($addTypesPages->getResult()) {
                $urlRedirect = URLADM . "list-types-pages/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewAddTypesPages();
            }
        } else {
            $this->viewAddTypesPages();
        }
    }

    private function viewAddTypesPages() {
        $this->data['sidebarActive'] = "list-types-pages";
        $loadView = new \Core\ConfigView("adms/Views/typesPages/addTypesPages", $this->data);
        $loadView->render();
    }

}

?>
<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AddGroupsPages Controller. Responsible for adding the groups of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AddGroupsPages
{

    private $data;
    private $formData;

    public function index() {
        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->formData['AddGroupsPages'])) {
            unset($this->formData['AddGroupsPages']);
            $addGroupsPages = new \App\adms\Models\AdmsAddGroupsPages();
            $addGroupsPages->create($this->formData);
            if ($addGroupsPages->getResult()) {
                $urlRedirect = URLADM . "list-groups-pages/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewAddGroupsPages();
            }
        } else {
            $this->viewAddGroupsPages();
        }
    }

    private function viewAddGroupsPages() {
        $this->data['sidebarActive'] = "list-groups-pages";
        $loadView = new \Core\ConfigView("adms/Views/groupsPages/addGroupsPages", $this->data);
        $loadView->render();
    }

}

?>
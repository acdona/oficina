<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditGroupsPages Controller. Responsible for editing the groups of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditGroupsPages
{

    private $data;
    private $formData;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->formData['EditGroupsPages']))) {
            $viewGroupsPages = new \App\adms\Models\AdmsEditGroupsPages();
            $viewGroupsPages->viewGroupsPages($this->id);
            if ($viewGroupsPages->getResult()) {
                $this->data['form'] = $viewGroupsPages->getDatabaseResult();
                $this->viewEditGroupsPages();
            } else {
                $urlRedirect = URLADM . "list-groups-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editGroupsPages();
        }
    }

    private function viewEditGroupsPages() {           
        $this->data['sidebarActive'] = "list-groups-pages";
        $loadView = new \Core\ConfigView("adms/Views/groupsPages/editGroupsPages", $this->data);
        $loadView->render();
    }

    private function editGroupsPages() {
        if (!empty($this->formData['EditGroupsPages'])) {
            unset($this->formData['EditGroupsPages']);
            $editGroupsPages = new \App\adms\Models\AdmsEditGroupsPages();
            $editGroupsPages->update($this->formData);
            if ($editGroupsPages->getResult()) {
                $urlRedirect = URLADM . "list-groups-pages/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditGroupsPages();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Grupo de página não encontrado!</div>";
            $urlRedirect = URLADM . "list-groups-pages/index";
            header("Location: $urlRedirect");
        }
    }

}

?>
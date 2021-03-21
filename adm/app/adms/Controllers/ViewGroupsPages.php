<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ViewGroupsPages Controller. Responsible for viewing the groups of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ViewGroupsPages
{

    private int $id;
    private $data;

    public function index($id) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewGroupsPages = new \App\adms\Models\AdmsViewGroupsPages();
            $viewGroupsPages->viewGroupsPages($this->id);
            if ($viewGroupsPages->getResult()) {
                $this->data['viewGroupsPages'] = $viewGroupsPages->getDatabaseResult();
                $this->viewGroupsPages();
            } else {
                $urlRedirect = URLADM . "list-groups-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não encontrado!</div>";
            $urlRedirect = URLADM . "list-groups-pages/index";
            header("Location: $urlRedirect");
        }
    }

    private function viewGroupsPages() {
        $this->data['sidebarActive'] = "list-groups-pages";
        $loadView = new \Core\ConfigView("adms/Views/groupsPages/viewGroupsPages", $this->data);
        $loadView->render();
    }

}

?>
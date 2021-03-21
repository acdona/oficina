<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ViewTypesPages Controller. Responsible for viewing the types of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ViewTypesPages
{

    private int $id;
    private $data;

    public function index($id) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewTypesPages = new \App\adms\Models\AdmsViewTypesPages();
            $viewTypesPages->viewTypesPages($this->id);
            if ($viewTypesPages->getResult()) {
                $this->data['viewTypesPages'] = $viewTypesPages->getDatabaseResult();
                $this->viewTypesPages();
            } else {
                $urlRedirect = URLADM . "list-types-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não encontrado!</div>";
            $urlRedirect = URLADM . "list-types-pages/index";
            header("Location: $urlRedirect");
        }
    }

    private function viewTypesPages() {
        $this->data['sidebarActive'] = "list-types-pages";
        $loadView = new \Core\ConfigView("adms/Views/typesPages/viewTypesPages", $this->data);
        $loadView->render();
    }

}

?>
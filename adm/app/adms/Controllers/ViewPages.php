<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ViewPages Controller. Responsible for Viewing the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ViewPages
{

    private int $id;
    private $data;

    public function index($id) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewPages = new \App\adms\Models\AdmsViewPages();
            $viewPages->viewPages($this->id);
            if ($viewPages->getResult()) {
                $this->data['viewPages'] = $viewPages->getDatabaseResult();
                $this->viewPages();
            } else {
                $urlRedirect = URLADM . "list-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Página não encontrada</div>";
            $urlRedirect = URLADM . "list-pages/index";
            header("Location: $urlRedirect");
        }
    }

    private function viewPages() {
        $this->data['sidebarActive'] = "list-pages";
        $loadView = new \Core\ConfigView("adms/Views/pages/viewPages", $this->data);
        $loadView->render();
    }


}

?>
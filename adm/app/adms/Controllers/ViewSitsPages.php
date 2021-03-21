<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ViewSitsPages Controller. Responsible for viewing the situations of the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewSitsPages
{

    private int $id;
    private $data;

    public function index($id) {
        $this->id = (int) $id;
        if (!empty($this->id)) {
            $viewSitsPages = new \App\adms\Models\AdmsViewSitsPages();
            $viewSitsPages->viewSitsPages($this->id);
            if ($viewSitsPages->getResult()) {
                $this->data['viewSitsPages'] = $viewSitsPages->getDatabaseResult();
                $this->viewSitsPages();
            } else {
                $urlRedirect = URLADM . "list-sits-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não encontrada!</div>";
            $urlRedirect = URLADM . "list-sits-pages/index";
            header("Location: $urlRedirect");
        }
    }
    
    private function viewSitsPages() {
        $this->data['sidebarActive'] = "list-sits-pages";
        $loadView = new \Core\ConfigView("adms/Views/sitsPages/viewSitsPages", $this->data);
        $loadView->render();
    }

}

?>
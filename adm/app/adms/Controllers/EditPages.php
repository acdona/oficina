<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * EditPages Controller. Responsible for editing the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditPages
{

    private $data;
    private $formData;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->formData['EditPage']))) {
            $viewPage = new \App\adms\Models\AdmsEditPages();
            $viewPage->viewPage($this->id);
            if ($viewPage->getResult()) {
                $this->data['form'] = $viewPage->getDatabaseResult();
                $this->viewEditPage();
            } else {
                $urlRedirect = URLADM . "list-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editPage();
        }
    }

    private function viewEditPage() {
        $listSelect = new \App\adms\Models\AdmsEditPages();
        $this->data['select'] = $listSelect->listSelect();

        $this->data['sidebarActive'] = "list-pages";

        $loadView = new \Core\ConfigView("adms/Views/pages/editPages", $this->data);
        $loadView->render();
    }

    private function editPage() {
        if (!empty($this->formData['EditPage'])) {
            unset($this->formData['EditPage']);
            $editPage = new \App\adms\Models\AdmsEditPages();
            $editPage->update($this->formData);
            if ($editPage->getResult()) {
                $urlRedirect = URLADM . "list-pages/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditPage();
            }
        } else {
            $_SESSION['msg'] = "Página não encontrado!<br>";
            $urlRedirect = URLADM . "list-pages/index";
            header("Location: $urlRedirect");
        }
    }


}

?>
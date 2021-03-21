<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditSitsPages Controller. Responsible for editing the situations of the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public   
 *
*/
class EditSitsPages
{

    private $data;
    private $formData;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->formData['EditSitsPages']))) {
            $viewSitsPages = new \App\adms\Models\AdmsEditSitsPages();
            $viewSitsPages->viewSitsPages($this->id);
            if ($viewSitsPages->getResult()) {
                $this->data['form'] = $viewSitsPages->getDatabaseResult();
                $this->viewEditSitsPages();
            } else {
                $urlRedirect = URLADM . "list-sits-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editSitsPages();
        }
    }

    private function viewEditSitsPages() {

        $listSelect = new \App\adms\Models\AdmsEditSitsPages();
        $this->data['select'] = $listSelect->listSelect();

        $this->data['sidebarActive'] = "list-sits-pages";

        $loadView = new \Core\ConfigView("adms/Views/sitsPages/editSitsPages", $this->data);
        $loadView->render();
    }

    private function editSitsPages() {
        if (!empty($this->formData['EditSitsPages'])) {
            unset($this->formData['EditSitsPages']);
            $editSitsPages = new \App\adms\Models\AdmsEditSitsPages();
            $editSitsPages->update($this->formData);
            if ($editSitsPages->getResult()) {
                $urlRedirect = URLADM . "list-sits-pages/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditSitsPages();
            }
        } else {
            $_SESSION['msg'] = "Situação de página não encontrada!<br>";
            $urlRedirect = URLADM . "list-sits-pages/index";
            header("Location: $urlRedirect");
        }
    }

}

?>
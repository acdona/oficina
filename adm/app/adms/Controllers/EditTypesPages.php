<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditTypesPages Controller. Responsible for editing the types of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditTypesPages
{

    private $data;
    private $formData;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->formData['EditTypesPages']))) {
            $viewTypesPages = new \App\adms\Models\AdmsEditTypesPages();
            $viewTypesPages->viewTypesPages($this->id);
            if ($viewTypesPages->getResult()) {
                $this->data['form'] = $viewTypesPages->getDatabaseResult();
                $this->viewEditTypesPages();
            } else {
                $urlRedirect = URLADM . "list-types-pages/index";
                header("Location: $urlRedirect");
            }
        } else {
            $this->editTypesPages();
        }
    }

    private function viewEditTypesPages() {
        $this->data['sidebarActive'] = "list-types-pages";
        $loadView = new \Core\ConfigView("adms/Views/typesPages/editTypesPages", $this->data);
        $loadView->render();
    }

    private function editTypesPages() {
        if (!empty($this->formData['EditTypesPages'])) {
            unset($this->formData['EditTypesPages']);
            $editTypesPages = new \App\adms\Models\AdmsEditTypesPages();
            $editTypesPages->update($this->formData);
            if ($editTypesPages->getResult()) {
                $urlRedirect = URLADM . "list-types-pages/index";
                header("Location: $urlRedirect");
            } else {
                $this->data['form'] = $this->formData;
                $this->viewEditTypesPages();
            }
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não encontrado!</div>";
            $urlRedirect = URLADM . "list-types-pages/index";
            header("Location: $urlRedirect");
        }
    }


}

?>
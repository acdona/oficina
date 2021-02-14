<?php
namespace App\sts\Controllers;

/**
 * Controller EditAccountCategory responsável por editar categoria das compras
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditAccountCategory
{

    private $dados;
    private $dadosForm;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditAccountCategory']))) {
            $viewAccountCategory = new \App\sts\Models\StsEditAccountCategory();
            $viewAccountCategory->viewAccountCategory($this->id);
            if ($viewAccountCategory->getResultado()) {
                $this->dados['form'] = $viewAccountCategory->getResultadoBd();
                $this->viewAccountCategory();
            } else {
                $urlDestino = URLADM . "list-account-category/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editAccountCategory();
        }
    }

    private function viewAccountCategory() {       
        
        $viewFooter = new \App\sts\Models\StsFooter();
        $this->dados['footer'] = $viewFooter->view();
        
        $carregarView = new \App\sts\core\ConfigView("sts/Views/accountCategory/editAccountCategory", $this->dados);
        $carregarView->renderizar();
    }

    private function editAccountCategory() {
        if (!empty($this->dadosForm['EditAccountCategory'])) {
            unset($this->dadosForm['EditAccountCategory']);
            $editAccountCategory = new \App\sts\Models\StsEditAccountCategory();
            $editAccountCategory->update($this->dadosForm);
            if ($editAccountCategory->getResultado()) {
                $urlDestino = URLADM . "list-account-category/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewAccountCategory();
            }
        } else {
            $_SESSION['msg'] = "Categoria não encontrada!<br>";
            $urlDestino = URLADM . "list-account-category/index";
            header("Location: $urlDestino");
        }
    }

}

?>
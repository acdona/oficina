<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller EditCategory responsável por editar categoria
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class EditCategory
{

    private $dados;
    private $dadosForm;
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditCategory']))) {
            $viewCategory = new \App\sts\Models\StsEditCategory();
            $viewCategory->viewCategory($this->id);
            if ($viewCategory->getResultado()) {
                $this->dados['form'] = $viewCategory->getResultadoBd();
                $this->viewCategory();
            } else {
                $urlDestino = URL . "list-category/index";
                header("Location: $urlDestino");
            }
        } else {
            $this->editCategory();
        }
    }

    private function viewCategory() {       
   
        $carregarView = new \App\sts\core\ConfigView("sts/Views/category/editCategory", $this->dados);
        $carregarView->renderizar();
    }

    private function editCategory() {
        if (!empty($this->dadosForm['EditCategory'])) {
            unset($this->dadosForm['EditCategory']);
            $editCategory = new \App\sts\Models\StsEditCategory();
            $editCategory->update($this->dadosForm);
            if ($editCategory->getResultado()) {
                $urlDestino = URL . "list-category/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewCategory();
            }
        } else {
            $_SESSION['msg'] = "Categoria não encontrada!<br>";
            $urlDestino = URL . "list-category/index";
            header("Location: $urlDestino");
        }
    }

}

?>
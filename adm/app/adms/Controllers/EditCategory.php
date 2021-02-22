<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * EditCategory Controller responsible for editing a category.
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
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private $dados;

    /** @var array $dadosForm Recebe os dados do formulário */
    private $dadosForm;

    /** @var int $id Recebe um inteiro referente ao  ID da categoria. */
    private $id;

    public function index($id) {
        $this->id = (int) $id;

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->id) AND (empty($this->dadosForm['EditCategory']))) {
            $viewCategory = new \App\adms\Models\AdmsEditCategory();
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
   
        $carregarView = new \App\adms\core\ConfigView("adms/Views/category/editCategory", $this->dados);
        $carregarView->renderizar();
    }

    private function editCategory() {
        if (!empty($this->dadosForm['EditCategory'])) {
            unset($this->dadosForm['EditCategory']);
            $editCategory = new \App\adms\Models\AdmsEditCategory();
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
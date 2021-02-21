<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AddCategory Controller responsible for adding a category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AddCategory
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private $dados;

    /** @var array $dadosForm Recebe os dados do formulário */
    private $dadosForm;

    public function index() {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->dadosForm['AddCategory'])){
            unset($this->dadosForm['AddCategory']);
            $createNewCategory = new \App\sts\Models\StsAddCategory();
            $createNewCategory->create($this->dadosForm);
            if($createNewCategory->getResultado()) {
                $urlDestino = URL . "add-category/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewNewCategory();
            }
        } else {
            $this->viewNewCategory();
        }
    }

       private function viewNewCategory() {  

            $carregarView = new \App\sts\core\ConfigView("sts/Views/category/addCategory", $this->dados);
            $carregarView->renderizar();   
       }

}

?>
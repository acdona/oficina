<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * AddccountCategory Controller responsible for adding a account category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AddAccountCategory
{

    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados=[];

    /** @var array $dadosForm Recebe os dados do formulário */
    private $dadosForm;

    public function index() {

        $this->dadosForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if(!empty($this->dadosForm['AddAccountCategory'])){
            unset($this->dadosForm['AddAccountCategory']);
            $createNewAccountCategory = new \App\adms\Models\AdmsAddAccountCategory();
            $createNewAccountCategory->create($this->dadosForm);
            if($createNewAccountCategory->getResultado()) {
                $urlDestino = URL . "add-account-category/index";
                header("Location: $urlDestino");
            } else {
                $this->dados['form'] = $this->dadosForm;
                $this->viewNewAccountCategory();
            }
        } else {
            $this->viewNewAccountCategory();
        }
    }

       private function viewNewAccountCategory() {  

            $carregarView = new \App\adms\core\ConfigView("adms/Views/accountCategory/addAccountCategory", $this->dados);
            $carregarView->renderizar();   
       }

}

?>
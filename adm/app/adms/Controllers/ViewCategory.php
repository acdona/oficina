<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * ViewCategory Controller responsible for viewing a category.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewCategory
{
    /** @var int $id Recebe um inteiro referente ao ID da cetagoria */
    private int $id;
    
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private $dados;

    public function index($id) {
        $this->id = $id;
        
        if (!empty($this->id)) {
            
            $viewCategory = new \App\adms\Models\AdmsViewCategory();
            $viewCategory->viewCategory($this->id);
            
            if ($viewCategory->getResultado()) {
                $this->dados['viewCategory'] = $viewCategory->getResultadoBd();
                $this->viewCategory();
            } else {
                $urlDestino = URL . "list-category/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "Categoria não encontrada!<br>";
            $urlDestino = URL . "list-category/index";
            header("Location: $urlDestino");
        }
    }
    
    private function viewCategory() {
       
        $carregarView = new \App\adms\core\ConfigView("adms/Views/category/viewCategory", $this->dados);
        $carregarView->renderizar();
    }

}

?>
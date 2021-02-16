<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}
/**
 * Controller ViewAccountCategory responsável por visualizar uma categoria de contas
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ViewAccountCategory
{
 
    /** @var int $id Recebe um inteiro ref. ao ID da categoria das contas */
    private $id;
    
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados;

    public function index($id) {
        $this->id = $id;
        
        if (!empty($this->id)) {
            
            $viewAccountCategory = new \App\sts\Models\StsViewAccountCategory();
            $viewAccountCategory->viewAccountCategory($this->id);
            
            if ($viewAccountCategory->getResultado()) {
                $this->dados['viewAccountCategory'] = $viewAccountCategory->getResultadoBd();
                $this->viewAccountCategory();
            } else {
                $urlDestino = URL . "list-account-category/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "Categoria não encontrada!<br>";
            $urlDestino = URL . "list-account-category/index";
            header("Location: $urlDestino");
        }
    }
    
    private function viewAccountCategory() {
       
        $carregarView = new \App\sts\core\ConfigView("sts/Views/accountCategory/viewAccountCategory", $this->dados);
        $carregarView->renderizar();
    }

}

?>
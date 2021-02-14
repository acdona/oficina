<?php
namespace App\sts\Controllers;

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
 
    private $id;
    private $dados;

    public function index($id) {
        $this->id = $id;
        
        if (!empty($this->id)) {
            
            $viewAccountCategory = new \App\sts\Models\StsViewAccountCategory();
            $viewAccountCategory->viewAccountCategory($this->id);
            
            if ($viewAccountCategory->getResultado()) {
                $this->dados['viewAccountCategory'] = $viewAccountCategory->getResultadoBd();
                $this->viewAccountCategory();
            } else {
                $urlDestino = URLADM . "list-account-category/index";
                header("Location: $urlDestino");
            }
        } else {
            $_SESSION['msg'] = "Categoria não encontrada da controller<br>";
            $urlDestino = URLADM . "list-account-category/index";
            header("Location: $urlDestino");
        }
    }
    
    private function viewAccountCategory() {

        $viewFooter = new \App\sts\Models\StsFooter();
        $this->dados['footer'] = $viewFooter->view();
        
        $carregarView = new \App\sts\core\ConfigView("sts/Views/accountCategory/viewAccountCategory", $this->dados);
        $carregarView->renderizar();
    }

}

?>
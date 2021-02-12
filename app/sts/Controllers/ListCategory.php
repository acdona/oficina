<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller ListCategory responsável por Listar Categorias
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListCategory
{

    private $dados;
    private $pag;
    
    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listCategory = new \App\sts\Models\StsListCategory();
        $listCategory->listCategory($this->pag);

        $this->dados['listCategory'] = $listCategory->getResultadoBd();
        $this->dados['pagination'] = $listCategory->getResultPg();
  
        $viewFooter = new \App\sts\Models\StsFooter();
        $this->dados['footer'] = $viewFooter->view();
    
        $carregarView = new \App\sts\core\ConfigView("sts/Views/category/listCategory", $this->dados);       
        $carregarView->renderizar();

    }

}

?>
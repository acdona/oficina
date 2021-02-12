<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller ListAccountCategory responsável pela  
 * manutenção das categorias das contas
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListAccountCategory
{

    private $dados;
    private $pag;

    public function index($pag = null) { 


        $this->pag = (int) $pag ? $pag : 1;
        
        $listAccountCategory = new \App\sts\Models\StsListAccountCategory();
        $listAccountCategory->listAccountCategory($this->pag);

        $this->dados['listAccountCategory'] = $listAccountCategory->getResultadoBd();
        $this->dados['pagination'] = $listAccountCategory->getResultPg();
  
        $viewFooter = new \App\sts\Models\StsFooter();
        $this->dados['footer'] = $viewFooter->view();
    
        $carregarView = new \App\sts\core\ConfigView("sts/Views/accountCategory/listAccountCategory", $this->dados);       
        $carregarView->renderizar();
    }

}

?>
<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListCategory Controller responsible for listing categories.
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
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados=[];
    
    /** @var int $pag um número inteiro referente a página */
    private $pag;
    
    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listCategory = new \App\adms\Models\AdmsListCategory();
        $listCategory->listCategory($this->pag);

        $this->dados['listCategory'] = $listCategory->getResultadoBd();
        $this->dados['pagination'] = $listCategory->getResultPg();
  
        $carregarView = new \App\adms\core\ConfigView("adms/Views/category/listCategory", $this->dados);       
        $carregarView->renderizar();

    }

}

?>
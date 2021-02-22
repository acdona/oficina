<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListAccountCategory Controller responsible for listing account categories.
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
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados;
    /** @var int $pag Recebe um inteiro referente a página. */
    private $pag;

    public function index($pag = null) { 

        $this->pag = (int) $pag ? $pag : 1;
        
        $listAccountCategory = new \App\adms\Models\AdmsListAccountCategory();
        $listAccountCategory->listAccountCategory($this->pag);

        $this->dados['listAccountCategory'] = $listAccountCategory->getResultadoBd();
        $this->dados['pagination'] = $listAccountCategory->getResultPg();
     
        $carregarView = new \App\adms\core\ConfigView("adms/Views/accountCategory/listAccountCategory", $this->dados);       
        $carregarView->renderizar();
    }

}

?>
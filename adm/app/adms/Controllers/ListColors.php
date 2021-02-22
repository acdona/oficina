<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListColors Controller responsible for listing colors.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListColors
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados=[];

    /** @var int $pag um número inteiro referente a página */
    private $pag;

    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listColors = new \App\adms\Models\AdmsListColors();
        $listColors->listColors($this->pag);
    
        $this->dados['listColors']   = $listColors->getResultBd();
        $this->dados['pagination'] = $listColors->getResultPg();

     
        $carregarView = new \App\adms\core\ConfigView("adms/Views/colors/listColors" , $this->dados);
        $carregarView->renderizar();
    }

}

?>
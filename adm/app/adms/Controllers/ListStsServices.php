<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListStsServices Controller responsible for listing categories.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListStsServices
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados=[];
    
    /** @var int $pag um número inteiro referente a página */
    private $pag;
    
    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listStsServices = new \App\adms\Models\AdmsListStsServices();
        $listStsServices->listStsServices($this->pag);

        $this->dados['listStsServices'] = $listStsServices->getResultadoBd();
        $this->dados['pagination'] = $listStsServices->getResultPg();
  echo "Controller"; exit;
        $carregarView = new \App\adms\core\ConfigView("adms/Views/stsServices/listStsServices", $this->dados);       
        $carregarView->renderizar();

    }

}

?>
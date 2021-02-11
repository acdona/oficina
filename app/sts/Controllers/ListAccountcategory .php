<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Controller ListAccountcategory responsável pela  
 * manutenção das categorias das contas
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListAccountcategory
{

    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private $dados;
    private $pag;

    /**
     * Instanciar a MODELS e receber o retorno
     * Instantiar a classe responsável em carregar a View e enviar os dados para View.
     * 
     * @return 
     */
    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;
        
        $listAccountcategory = new \App\sts\Models\StsListAccountcategory();
        $listAccountcategory->listAccountcategory($this->pag);
        if($listAccountcategory->getResultado()){
            $this->dados['sts_account_categories'] = $listAccountcategory->getResultadoBd();
            $this->dados['pagination'] = $listAccountcategory->getResultPg();

        } else {
            $this->dados['sts_account_categories'] = [];
            $this->dados['pagination'] = null;
        }
            
       $carregarView = new \App\sts\core\ConfigView("sts/Views/accountCategory/listAccountcategory", $this->dados);
       $carregarView->renderizar();
    }

}

?>
<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}

/**
 * Controller AccountCategory responsável pela  
 * manutenção das categorias das contas
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AccountCategory
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
        
        $accountCategory = new \App\sts\Models\StsAccountCategory();
        $accountCategory->index($this->pag);
        
        $this->dados['viewCategory'] = $accountCategory->index();
        $this->dados['pagination'] = $accountCategory->getResultPg();
        
        $viewFooter = new \App\sts\Models\StsFooter();
        $this->dados['footer'] = $viewFooter->view();
        
        $carregarView = new \App\sts\core\ConfigView("sts/Views/accountCategory/accountcategory", $this->dados);
        $carregarView->renderizar();
    }

}

?>
<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListCities Controller responsible for listing cities.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListCities
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados=[];

    /** @var int $pag um número inteiro referente a página */
    private $pag;

    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listCities = new \App\sts\Models\StsListCities();
        $listCities->listCities($this->pag);
    
        $this->dados['listCities']   = $listCities->getResultBd();
        $this->dados['pagination'] = $listCities->getResultPg();

     
        $carregarView = new \App\sts\core\ConfigView("sts/Views/cities/listCities" , $this->dados);
        $carregarView->renderizar();
    }

}

?>
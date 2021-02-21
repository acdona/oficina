<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListUsers Controller responsible for listing users.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListUsers
{
    /** @var array $dados Recebe os dados que devem ser enviados para VIEW */
    private array $dados;
   
    /** @var int $pag um número inteiro referente a página */
    private int $pag;

    public function index($pag = null) {
        
        $this->pag = (int) $pag ? $pag : 1;

        $listUsers = new \App\sts\Models\StsListUsers();
        $listUsers->listUsers($this->pag);

        if($listUsers->getResultado()) {
            $this->dados['listUsers'] = $listUsers->getResultadoBd();
            $this->dados['pagination'] = $listUsers->getResultPg();
        }else {
            $this->dados['listUsers'] = [];
            $this->dados['pagination'] = null;
        }
        
        $carregarView = new \App\sts\core\ConfigView("sts/Views/user/listUsers" , $this->dados);
        $carregarView->renderizar();
    }

}

?>
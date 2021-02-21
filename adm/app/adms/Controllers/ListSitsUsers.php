<?php
namespace App\sts\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Classe ListSitsUsers responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class ListSitsUsers
{

    private $dados;
    private $pag;
    
    public function index($pag = null) {
        
        $this->pag = (int) $pag ? $pag : 1;
        
        $listSitsUsers= new \App\sts\Models\StsListSitsUsers();
        $listSitsUsers->listSitsUsers($this->pag);
        if($listSitsUsers->getResultado()){
            $this->dados['listSitsUsers'] = $listSitsUsers->getResultadoBd();
            $this->dados['pagination'] = $listSitsUsers->getResultPg();
        }else{
            $this->dados['listSitsUsers'] = [];
            $this->dados['pagination'] = null;
        }
        
       $carregarView = new \App\sts\core\ConfigView("sts/Views/sitsUser/listSitsUsers", $this->dados);
       $carregarView->renderizar();
    }

}

?>
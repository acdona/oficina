<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * Classe ListConfEmails responsável por 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListConfEmails
{

    private $dados;
    
    public function index() {
        
        $listConfEmails= new \App\adms\Models\AdmsListConfEmails();
        $listConfEmails->listConfEmails();
        if($listConfEmails->getResultado()){
            $this->dados['listConfEmails'] = $listConfEmails->getResultadoBd();
        }else{
            $this->dados['listConfEmails'] = [];
        }
        
       $carregarView = new \App\adms\core\ConfigView("adms/Views/confEmails/listConfEmails", $this->dados);
       $carregarView->renderizar();
    }


}

?>
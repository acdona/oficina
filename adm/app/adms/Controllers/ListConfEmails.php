<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}


/**
 * ListConfEmails Controller. Responsible for email confirmation.
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

    private $data;
    private $pag;
    
    public function index($pag = null) {
        $this->pag = (int) $pag ? $pag : 1;
        
        $listConfEmails= new \App\adms\Models\AdmsListConfEmails();
        $listConfEmails->listConfEmails();
        if($listConfEmails->getResult()){
            $this->data['listConfEmails'] = $listConfEmails->getDatabaseResult();
            $this->data['pagination'] = $listConfEmails->getResultPg();
        }else{
            $this->data['listConfEmails'] = [];
            $this->data['pagination'] = null;
        }
        
        $this->data['sidebarActive'] = "list-conf-emails";
        $loadView = new \Core\ConfigView("adms/Views/confEmails/listConfEmails", $this->data);
        $loadView->render();
    }


}

?>
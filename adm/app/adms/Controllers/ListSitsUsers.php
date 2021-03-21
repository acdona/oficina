<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListSitsUsers Controller. Responsible for listing the user's situation. 
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

    private $data;
    private $pag;
    
    public function index($pag = null) {
        
        $this->pag = (int) $pag ? $pag : 1;
        
        $listSitsUsers= new \App\adms\Models\AdmsListSitsUsers();
        $listSitsUsers->listSitsUsers($this->pag);
        if($listSitsUsers->getResult()){
            $this->data['listSitsUsers'] = $listSitsUsers->getDatabaseResult();
            $this->data['pagination'] = $listSitsUsers->getResultPg();
        }else{
            $this->data['listSitsUsers'] = [];
            $this->data['pagination'] = null;
        }
       
        $this->data['sidebarActive'] = "list-sits-users"; 
        $loadView = new \Core\ConfigView("adms/Views/sitsUser/listSitsUsers", $this->data);
        $loadView->render();
    }

}

?>
<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * DeleteGroupsPages Controller. Responsible for deleting the groups of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DeleteGroupsPages
{

    private $id;
    
    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteGroupsPages = new \App\adms\Models\AdmsDeleteGroupsPages();
            $deleteGroupsPages->deleteGroupsPages($this->id);
        }else{
            $_SESSION['msg'] = "Erro: Necessário selecionar um grupo de página!";
        }
        
        $urlRedirect = URLADM . "list-groups-pages/index";
        header("Location: $urlRedirect");
    }

}

?>
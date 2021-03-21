<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * DeleteTypesPages Controller. Responsible for deleting the types of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class DeleteTypesPages
{

    private $id;
    
    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteTypesPages = new \App\adms\Models\AdmsDeleteTypesPages();
            $deleteTypesPages->deleteTypesPages($this->id);
        }else{
            $_SESSION['msg'] = "Erro: Necessário selecionar um tipo de página!";
        }
        
        $urlRedirect = URLADM . "list-types-pages/index";
        header("Location: $urlRedirect");
    }

}

?>
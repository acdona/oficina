<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * DeletePages Controller. Responsible for deleting the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DeletePages
{

    private $id;

    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deletePage = new \App\adms\Models\AdmsDeletePages();
            $deletePage->deletePages($this->id);
        }else{
            $_SESSION['msg'] = "Erro: Necessário selecionar uma página!";
        }
        
        $urlRedirect = URLADM . "list-pages/index";
        header("Location: $urlRedirect");
    }


}

?>
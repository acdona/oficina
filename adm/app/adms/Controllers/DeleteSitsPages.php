<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * DeleteSitsPages Controller. Responsible for deleting the situations of the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class DeleteSitsPages
{

    private $id;

    public function index($id = null) {
        $this->id = (int) $id;
        
        if(!empty($this->id)){
            $deleteSitsPages = new \App\adms\Models\AdmsDeleteSitsPages();
            $deleteSitsPages->deleteSitsPages($this->id);
        }else{
            $_SESSION['msg'] = "Erro: Necessário selecionar uma situação de página!";
        }
        
        $urlRedirect = URLADM . "list-sits-pages/index";
        header("Location: $urlRedirect");
    }


}

?>
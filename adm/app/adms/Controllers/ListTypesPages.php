<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListTypesPages Controller. Responsible for listing the types of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListTypesPages
{

    
    private $data;
    private $pag;

    public function index($pag = null)
    {
        $this->pag = (int) $pag ? $pag : 1;

        $listTypesPages = new \App\adms\Models\AdmsListTypesPages();
        $listTypesPages->listTypesPages($this->pag);
        if ($listTypesPages->getResult()) {
            $this->data['listTypesPages'] = $listTypesPages->getDatabaseResult();
            $this->data['pagination'] = $listTypesPages->getResultPg();
        } else {
            $this->data['listTypesPages'] = [];
            $this->data['pagination'] = null;
        }
        $this->data['pag'] = $this->pag;
        $this->data['sidebarActive'] = "list-types-pages";
        $loadView = new \Core\ConfigView("adms/Views/typesPages/listTypesPages", $this->data);
        $loadView->render();
    }

}

?>
<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListGroupsPages Controller. Responsible for listing the groups of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 * 
 *
*/
class ListGroupsPages
{

    private $data;
    private $pag;

    public function index($pag = null)
    {
        $this->pag = (int) $pag ? $pag : 1;

        $listGroupsPages = new \App\adms\Models\AdmsListGroupsPages();
        $listGroupsPages->listGroupsPages($this->pag);
        if ($listGroupsPages->getResult()) {
            $this->data['listGroupsPages'] = $listGroupsPages->getDatabaseResult();
            $this->data['pagination'] = $listGroupsPages->getResultPg();
        } else {
            $this->data['listGroupsPages'] = [];
            $this->data['pagination'] = null;
        }
        $this->data['pag'] = $this->pag;
        $this->data['sidebarActive'] = "list-groups-pages";
        $loadView = new \Core\ConfigView("adms/Views/groupsPages/listGroupsPages", $this->data);
        $loadView->render();
    }


}

?>
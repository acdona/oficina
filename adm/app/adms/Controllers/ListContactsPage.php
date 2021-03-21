<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListContactsPage Controller. Responsible for listing the contacts page. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListContactsPage
{

    
    private $data;
    private $pag;

    public function index($pag = null)
    {
        $this->pag = (int) $pag ? $pag : 1;

        $listContactsPage = new \App\adms\Models\StsListContactsPage();
        $listContactsPage->listContactsPage($this->pag);
        if ($listContactsPage->getResult()) {
            $this->data['listContactsPage'] = $listContactsPage->getDatabaseResult();
            $this->data['pagination'] = $listContactsPage->getResultPg();
        } else {
            $this->data['listContactsPage'] = [];
            $this->data['pagination'] = null;
        }
        $this->data['pag'] = $this->pag;
        $this->data['sidebarActive'] = "list-contacts-pages";
        $loadView = new \Core\ConfigView("adms/Views/contactsPage/listContactsPage", $this->data);
        $loadView->render();
    }

}

?>
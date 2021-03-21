<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListSitsPages Controller. Responsible for listing situations of the pages.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListSitsPages
{

    private $data;
    private $pag;

    public function index($pag = null) {
        $this->pag = (int) $pag ? $pag : 1;

        $listSitsPages = new \App\adms\Models\AdmsListSitsPages();
        $listSitsPages->listSitsPages($this->pag);
        if ($listSitsPages->getResult()) {
            $this->data['listSitsPages'] = $listSitsPages->getDatabaseResult();
            $this->data['pagination'] = $listSitsPages->getResultPg();
        } else {
            $this->data['listSitsPages'] = [];
            $this->data['pagiantion'] = null;
        }

        $this->data['sidebarActive'] = "list-sits-pages";
        $loadView = new \Core\ConfigView("adms/Views/sitsPages/listSitsPages", $this->data);
        $loadView->render();
    }

    

}

?>
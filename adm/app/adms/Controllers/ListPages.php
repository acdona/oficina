<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListPages Controller. Responsible for listing the pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListPages
{

    private $data;
    private $pag;

    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listPages = new \App\adms\Models\AdmsListPages();
        $listPages->listPages($this->pag);
        if ($listPages->getResult()) {
            $this->data['listPages'] = $listPages->getDatabaseResult();
            $this->data['pagination'] = $listPages->getResultPg();
        } else {
            $this->data['listPages'] = [];
            $this->data['pagination'] = null;
        }

        $this->data['sidebarActive'] = "list-pages";
        $loadView = new \Core\ConfigView("adms/Views/pages/listPages", $this->data);
        $loadView->render();
    }


}

?>
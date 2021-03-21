<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListPermission Controller. Responsible for listing access permissions.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListPermission
{

    private $data;
    private $pag;
    private $level;

    public function index($pag = null) {

        $this->level = filter_input(INPUT_GET, 'level', FILTER_SANITIZE_NUMBER_INT);
      
        $this->pag = (int) $pag ? $pag : 1;

        $listPermission = new \App\adms\Models\AdmsListPermission();
        $listPermission->listPermission($this->pag, $this->level);
        if ($listPermission->getResult()) {
            $this->data['listPermission'] = $listPermission->getDatabaseResult();
            $this->data['pagination'] = $listPermission->getResultPg();
            $this->data['pag'] = $this->pag;
        } else {
            $this->data['listPermission'] = [];
            $this->data['pagination'] = null;
            $this->data['pag'] = $this->pag;
        }

        $this->data['sidebarActive'] = "list-access-levels";
        $loadView = new \Core\ConfigView("adms/Views/permission/listPermission", $this->data);
        $loadView->render();
    }

}

?>
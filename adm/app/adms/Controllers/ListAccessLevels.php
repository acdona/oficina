<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListAccessLevels Controller. Responsible for listing the access levels.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListAccessLevels
{
    /** @var array $data Receives the data that must be sent to VIEW */
    private array $data=[];

    /** @var int $pag Receives an integer referring to the page */
    private $pag;

    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listAccessLevels = new \App\adms\Models\AdmsListAccessLevels();
        $listAccessLevels->listAccessLevels($this->pag);

        if ($listAccessLevels->getResult()){
            $this->data['listAccessLevels']   = $listAccessLevels->getDatabaseResult();
            $this->data['pagination'] = $listAccessLevels->getResultPg();

        } else
        {
            $this->data['listAccessLevels'] = [];
            $this->data['pagination'] = null;
        }
        $this->data['pag'] = $this->pag;
        $this->data['sidebarActive'] = "list-access-levels";
        $loadView = new \Core\ConfigView("adms/Views/accessLevels/listAccessLevels" , $this->data);
        $loadView->render();
    }

}

?>
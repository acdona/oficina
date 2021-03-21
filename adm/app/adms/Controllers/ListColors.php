<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * ListColors Controller responsible for listing colors.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class ListColors
{
    /** @var array $data Receives the data that must be sent to VIEW */
    private array $data=[];

    /** @var int $pag Receives an integer referring to the page */
    private $pag;

    public function index($pag = null) {

        $this->pag = (int) $pag ? $pag : 1;

        $listColors = new \App\adms\Models\AdmsListColors();
        $listColors->listColors($this->pag);
    
        $this->data['listColors']   = $listColors->getDatabaseResult();
        $this->data['pagination'] = $listColors->getResultPg();

        $this->data['sidebarActive'] = "list-colors";
        $loadView = new \Core\ConfigView("adms/Views/colors/listColors" , $this->data);
        $loadView->render();
    }

}

?>
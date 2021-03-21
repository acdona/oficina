<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * OrderGroupsPages Controller. Responsible for sorting the ordes of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class OrderGroupsPages
{

    private $pag;
    private $id;

    public function index($id = null) {
        $this->id = (int) $id;
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->id) AND (!empty($this->pag))) {
            $orderGroupsPages = new \App\adms\Models\AdmsOrderGroupsPages();
            $orderGroupsPages->orderGroupsPages($this->id);
            $urlRedirect = URLADM . 'list-groups-pages/index/' . $this->pag;
            header("Location: $urlRedirect");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Grupo de página não encontrado!</div>";
            $urlRedirect = URLADM . 'list-groups-pages/index';
            header("Location: $urlRedirect");
        }
    }


}

?>
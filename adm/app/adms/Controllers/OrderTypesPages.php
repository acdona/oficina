<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * OrderTypesPages Controller. Responsible for sorting the types of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class OrderTypesPages
{

    private $pag;
    private $id;

    public function index($id = null) {
        $this->id = (int) $id;
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);
        if (!empty($this->id) AND (!empty($this->pag))) {
            $orderTypesPages = new \App\adms\Models\AdmsOrderTypesPages();
            $orderTypesPages->orderTypesPages($this->id);
            $urlRedirect = URLADM . 'list-types-pages/index/' . $this->pag;
            header("Location: $urlRedirect");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Tipo de página não encontrado!</div>";
            $urlRedirect = URLADM . 'list-types-pages/index';
            header("Location: $urlRedirect");
        }
    }

}

?>
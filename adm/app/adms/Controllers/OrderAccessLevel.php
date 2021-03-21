<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * OrderAccessLevel Controller. Responsible for ordering the access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class OrderAccessLevel
{

    private $pag;
    private $id;

    public function index($id = null) {
        $this->id = (int) $id;

        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        if (!empty($this->id) AND (!empty($this->pag))) {
            $orderAccessLevel = new \App\adms\Models\AdmsOrderAccessLevel();
            $orderAccessLevel->orderAccessLevel($this->id);
            $urlRedirect = URLADM . 'list-access-levels/index/' . $this->pag;
            header("Location: $urlRedirect");
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso não encontrado!</div>";
            $urlRedirect = URLADM . 'list-access-levels/index';
            header("Location: $urlRedirect");
        }
    }


}

?>
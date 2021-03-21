<?php
namespace App\adms\Controllers;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * EditPermission Controller. Responsible for editing permissions. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class EditPermission
{

    private int $id;
    private int $level;
    private int $pag;

    public function index() {

        $this->id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $this->level = filter_input(INPUT_GET, "level", FILTER_SANITIZE_NUMBER_INT);
        $this->pag = filter_input(INPUT_GET, "pag", FILTER_SANITIZE_NUMBER_INT);

        $editPermission = new \App\adms\Models\AdmsEditPermission();
        $editPermission->editPermission($this->id);

         $urlDestiny = URLADM . "list-permission/index/{$this->pag}?level={$this->level}";
          header("Location: $urlDestiny");
    }

}

?>
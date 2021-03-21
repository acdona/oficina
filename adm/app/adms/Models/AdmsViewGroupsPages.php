<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsViewGroupsPages Model. Responsible for viewing the groups of pages.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsViewGroupsPages
{

    private $databaseResult;
    private bool $result;
    private int $id;
    
    function getDatabaseResult()
    {
        return $this->databaseResult;
    }

    function getResult(): bool
    {
        return $this->result;
    }

    public function viewGroupsPages($id) {
        $this->id = (int) $id;
        $viewGroupsPages = new \App\adms\Models\helper\AdmsRead();
        $viewGroupsPages->fullRead("SELECT id, name, order_group_pg
                FROM adms_groups_pgs
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");
        $this->databaseResult = $viewGroupsPages->getReadingResult();
        if($this->databaseResult){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Grupo de página não encontrado!</div>";
            $this->result = false;
        }
    }

}

?>
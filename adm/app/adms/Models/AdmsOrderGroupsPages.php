<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsOrderGroupsPages Model. Responsible for sorting the groups of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsOrderGroupsPages
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;
    private $databaseResultPrev;

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getResult(): bool {
        return $this->result;
    }

    public function orderGroupsPages($id = null) {
        $this->id = (int) $id;
        $viewOrderGroupsPages = new \App\adms\Models\helper\AdmsRead();
        $viewOrderGroupsPages->fullRead("SELECT id, order_group_pg
                    FROM adms_groups_pgs
                    WHERE id=:id
                    LIMIT :limit", "id={$this->id}&limit=1");
        $this->databaseResult = $viewOrderGroupsPages->getReadingResult();
        if ($this->databaseResult) {
            $this->viewPrevGroupsPages();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do grupo de página não encontrado!</div>";
            $this->result = false;
        }
    }

    private function viewPrevGroupsPages() {
        $prevOrderGroupsPages = new \App\adms\Models\helper\AdmsRead();
        $prevOrderGroupsPages->fullRead("SELECT id, order_group_pg
                    FROM adms_groups_pgs
                    WHERE order_group_pg <:order_group_pg
                    ORDER BY order_group_pg DESC
                    LIMIT :limit", "order_group_pg={$this->databaseResult[0]['order_group_pg']}&limit=1");
        $this->databaseResultPrev = $prevOrderGroupsPages->getReadingResult();
        if ($this->databaseResultPrev) {
            $this->editMoveDown();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do grupo de página não encontrado!</div>";
            $this->result = false;
        }
    }

    private function editMoveDown() {
        $this->data['order_group_pg'] = $this->databaseResult[0]['order_group_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_groups_pgs", $this->data, "WHERE id=:id", "id={$this->databaseResultPrev[0]['id']}");

        if ($moveDown->getResult()) {
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do grupo de página não editado com sucesso!</div>";
            $this->result = false;
        }
    }

    private function editMoveUp() {
        $this->data['order_group_pg'] = $this->databaseResultPrev[0]['order_group_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_groups_pgs", $this->data, "WHERE id=:id", "id={$this->databaseResult[0]['id']}");

        if ($moveDown->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Ordem do grupo de página editado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do grupo de página não editado com sucesso!</div>";
            $this->result = false;
        }
    }

}

?>
<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsOrderTypesPages Model. Responsible for sorting the types of pages. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public 
 *
*/
class AdmsOrderTypesPages
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

    public function orderTypesPages($id = null) {
        $this->id = (int) $id;
        $viewOrderTypesPages = new \App\adms\Models\helper\AdmsRead();
        $viewOrderTypesPages->fullRead("SELECT id, order_type_pg
                    FROM adms_types_pgs
                    WHERE id=:id
                    LIMIT :limit", "id={$this->id}&limit=1");
        $this->databaseResult = $viewOrderTypesPages->getReadingResult();
        if ($this->databaseResult) {
            $this->viewPrevTypesPages();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do tipo de página não encontrado!</div>";
            $this->result = false;
        }
    }

    private function viewPrevTypesPages() {
        $prevOrderTypesPages = new \App\adms\Models\helper\AdmsRead();
        $prevOrderTypesPages->fullRead("SELECT id, order_type_pg
                    FROM adms_types_pgs
                    WHERE order_type_pg <:order_type_pg
                    ORDER BY order_type_pg DESC
                    LIMIT :limit", "order_type_pg={$this->databaseResult[0]['order_type_pg']}&limit=1");
        $this->databaseResultPrev = $prevOrderTypesPages->getReadingResult();
        if ($this->databaseResultPrev) {
            $this->editMoveDown();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do tipo de página não encontrado!</div>";
            $this->result = false;
        }
    }

    private function editMoveDown() {
        $this->data['order_type_pg'] = $this->databaseResult[0]['order_type_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_types_pgs", $this->data, "WHERE id=:id", "id={$this->databaseResultPrev[0]['id']}");

        if ($moveDown->getResult()) {
            $this->editMoveUp();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do tipo de página não editado com sucesso!</div>";
            $this->result = false;
        }
    }

    private function editMoveUp() {
        $this->data['order_type_pg'] = $this->databaseResultPrev[0]['order_type_pg'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_types_pgs", $this->data, "WHERE id=:id", "id={$this->databaseResult[0]['id']}");

        if ($moveDown->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Ordem do tipo de página editado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do tipo de página não editado com sucesso!</div>";
            $this->result = false;
        }
    }

}

?>
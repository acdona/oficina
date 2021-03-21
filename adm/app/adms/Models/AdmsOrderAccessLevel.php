<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsOrderAccessLevel Model. Responsible for ordering the access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsOrderAccessLevel
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;
    private $databaseResultPrev;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    function getDatabaseResultPrev() {
        return $this->databaseResultPrev;
    }

    public function orderAccessLevel($id = null) {
        $this->id = (int) $id;
        $viewAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $viewAccessLevel->fullRead("SELECT id, order_levels 
                FROM adms_access_levels 
                WHERE id=:id 
                AND order_levels >:order_levels
                LIMIT :limit", "id={$this->id}&order_levels=" . $_SESSION['order_levels'] . "&limit=1");

        $this->databaseResult = $viewAccessLevel->getReadingResult();

        if ($this->databaseResult) {
            
            $this->viewPrevAccessLevel();
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso não encontrado!</div>";
            $this->result = false;
        }
    }
    
    private function viewPrevAccessLevel() {
        
        $prevAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $prevAccessLevel->fullRead("SELECT id, order_levels
                FROM adms_access_levels
                WHERE order_levels <:order_levels 
                AND order_levels >:order_levels_user
                ORDER BY order_levels DESC 
                LIMIT :limit", "order_levels={$this->databaseResult[0]['order_levels']}&order_levels_user=" . $_SESSION['order_levels'] . "&limit=1");

        $this->databaseResultPrev = $prevAccessLevel->getReadingResult();
      
        if ($this->databaseResultPrev) {
            
            $this->editMoveDown();
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso não encontrado!</div>";
            $this->result = false;
        }
    }
    
    private function editMoveDown() {
        
        $this->data['order_levels'] = $this->databaseResult[0]['order_levels'];
        $this->data['modified'] = date("Y-m-d H:i:s");
      
        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_access_levels", $this->data, "WHERE id=:id", "id={$this->databaseResultPrev[0]['id']}");
        
        if($moveDown->getResult()){

            $this->editMoveUp();
        } else {
            
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do nível de acesso não editada!</div>";
            $this->result = false;
        }
    }

    private function editMoveUp() {
        $this->data['order_levels'] = $this->databaseResultPrev[0]['order_levels'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $moveDown = new \App\adms\Models\helper\AdmsUpdate();
        $moveDown->exeUpdate("adms_access_levels", $this->data, "WHERE id=:id", "id={$this->databaseResult[0]['id']}");
        
        if ($moveDown->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Ordem do nível de acesso editada com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Ordem do nível de acesso não editada!</div>";
            $this->result = false;
        }
    }
}
?>
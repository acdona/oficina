<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditAccessLevel Model. Responsible for editing an access level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditAccessLevel
{

    /** @var array $databaseResult Receives the database result. */
    private array $databaseResult;

    /** @var bool $result Returns whether the database query worked. */
    private bool $result;

    /** @var int $id Receives an integer referring to the access level ID. */
    private int $id;

    /** @var array $data Receives the data that must be sent to VIEW. */
    private array $data;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewAccessLevel($id) {

        $this->id = (int) $id;

        $viewAccessLevel = new \App\adms\Models\helper\AdmsRead();
        $viewAccessLevel->fullRead("SELECT id, name, order_levels
                FROM adms_access_levels
                WHERE id=:id
                AND order_levels >:order_levels
                LIMIT :limit", "id={$this->id}&order_levels=" . $_SESSION['order_levels'] . "&limit=1");

        $this->databaseResult = $viewAccessLevel->getReadingResult();
        if ($this->databaseResult) {
            
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso não encontrado ou sem permissão de acesso!</div>";
            $this->result = false;
        }
    }

    public function update(array $data) {
        $this->data = $data;
       
        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    private function edit() {
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upAccessLevel = new \App\adms\Models\helper\AdmsUpdate();
        $upAccessLevel->exeUpdate("adms_access_levels", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upAccessLevel->getResult()) {
        
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Nível de acesso editado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso não editado!</div>";
            
            $this->result = false;
        }
    }

}

?>
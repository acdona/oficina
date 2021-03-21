<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditColor Model responsible for editing a color.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditColor
{

    /** @var array $databaseResult Receives the database result. */
    private array $databaseResult;

    /** @var bool $result Returns whether the database query worked. */
    private bool $result;

    /** @var int $id Receives an integer referring to the ID. */
    private int $id;

    /** @var array $data Receives the data that must be sent to VIEW. */
    private array $data;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewColor($id) {
        $this->id = (int) $id;
        $viewColor = new \App\adms\Models\helper\AdmsRead();
        $viewColor->fullRead("SELECT id, name, color
                FROM adms_colors
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewColor->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "Cor não encontrada!<br>";
            $this->result = false;
        }
    }

    public function update(array $data) {
        $this->data = $data;

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }

    private function valInput() {
        $valColor = new \App\adms\Models\helper\AdmsValColor();
        $valColor->valColor($this->data['name']);
        
        if ($valColor->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }


    private function edit() {
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upColor = new \App\adms\Models\helper\AdmsUpdate();
        $upColor->exeUpdate("adms_colors", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upColor->getResult()) {
        
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Cor editada com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Cor não editada!</div>";
            
            $this->result = false;
        }
    }

}

?>
<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) { 
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditConfEmailPass Model. Responsible for setting the email password.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditConfEmailPass
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewConfEmailPass($id) {
        $this->id = (int) $id;
        $viewConfEmailsPass = new \App\adms\Models\helper\AdmsRead();
        $viewConfEmailsPass->fullRead("SELECT id
                FROM adms_confs_emails
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewConfEmailsPass->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: E-mail não encontrado!</div>";
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

        $upConfEmailsPass = new \App\adms\Models\helper\AdmsUpdate();
        $upConfEmailsPass->exeUpdate("adms_confs_emails", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upConfEmailsPass->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Senha do e-mail editado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Senha do e-mail não editado com sucesso!</div>";
            $this->result = false;
        }
    }

}

?>
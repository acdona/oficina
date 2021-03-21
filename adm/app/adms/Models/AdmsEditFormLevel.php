<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditFormLevel Model. Responsible for editing the form level.
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditFormLevel
{

    private $databaseResult;
    private bool $result;
    private array $data;
    private $listRegistryEdit;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewFormLevel() {
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT form.id, form.adms_access_level_id
                FROM adms_levels_forms form
                LIMIT :limit", "limit=1");

        $this->databaseResult = $viewUser->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
          
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso, para formulário novo usuário, não encontrado!</div>";
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

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_levels_forms", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Nível de acesso, para formulário novo usuário, editado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Nível de acesso, para formulário novo usuário, não editado!</div>";
            $this->result = false;
        }
    }

    public function listSelect() {
        
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_lev, name name_lev
                FROM adms_access_levels
                WHERE order_levels >:order_levels
                ORDER BY name ASC", "order_levels=" . $_SESSION['order_levels']);
        $registry['lev'] = $list->getReadingResult();

        $this->listRegistryEdit = ['lev' => $registry['lev']];
        
        return $this->listRegistryEdit;
        
    }
}
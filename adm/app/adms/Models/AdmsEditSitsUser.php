<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * AdmsEditSitsUser Model. Responsible for editing the user's situation. 
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditSitsUser
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;
    private $listRegistryEdit;

    function getResult(): bool {
        return $this->result;
    }

    function getdatabaseResult() {
        return $this->databaseResult;
    }

    public function viewSitsUser($id) {
        $this->id = (int) $id;
        $viewSitsUser = new \App\adms\Models\helper\AdmsRead();
        $viewSitsUser->fullRead("SELECT id, name, adms_color_id
                FROM adms_sits_users
                WHERE id=:id
                LIMIT :limit", "id={$this->id}&limit=1");

        $this->databaseResult = $viewSitsUser->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação de usuário não encontrado!</div>";
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
        $upUser->exeUpdate("adms_sits_users", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Situação para usuário editado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Situação para usuário não editado com sucesso!</div>";
            $this->result = false;
        }
    }
    
    public function listSelect() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_cor, name name_cor FROM adms_colors ORDER BY name ASC");
        $registry['cor'] = $list->getReadingResult();
        
        $this->listRegistryEdit = ['cor' => $registry['cor']];
        
        return $this->listRegistryEdit;
    }


}

?>
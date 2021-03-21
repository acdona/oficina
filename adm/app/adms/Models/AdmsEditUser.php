<?php
namespace App\adms\Models;

if (!defined('R4F5CC')) {
    header("Location: /");
    die("Erro: Página não encontrada!");
}

/**
 * Model AdmsEditUser responsável por  editar usuário
 *
 * @version 1.0
 *
 * @author Antonio Carlos Doná
 *
 * @access public
 *
*/
class AdmsEditUser
{

    private $databaseResult;
    private bool $result;
    private int $id;
    private array $data;
    private array $dataExitVal;
    private $listRegistryEdit;

    function getResult(): bool {
        return $this->result;
    }

    function getDatabaseResult() {
        return $this->databaseResult;
    }

    public function viewUser($id) {
        $this->id = (int) $id;
        $viewUser = new \App\adms\Models\helper\AdmsRead();
        $viewUser->fullRead("SELECT usu.id, usu.name, usu.nickname, usu.email, usu.username, usu.adms_sits_user_id, usu.adms_access_level_id
                FROM adms_users usu
                INNER JOIN adms_access_levels As lev ON lev.id=usu.adms_access_level_id
                WHERE usu.id=:id AND lev.order_levels >:order_levels
                LIMIT :limit", "id={$this->id}&order_levels=".$_SESSION['order_levels']."&limit=1");

        $this->databaseResult = $viewUser->getReadingResult();
        if ($this->databaseResult) {
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não encontrado!</div>";
            $this->result = false;
        }
    }

    public function update(array $data) {
        $this->data = $data;

        $this->dataExitVal['nickname'] = $this->data['nickname'];
        unset($this->data['nickname']);

        $valEmptyField = new \App\adms\Models\helper\AdmsValEmptyField();
        $valEmptyField->validateData($this->data);
        
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else {
            $this->result = false;
        }
    }

    private function valInput() {
        $valEmail = new \App\adms\Models\helper\AdmsValEmail();
        $valEmail->validateEmail($this->data['email']);

        $valEmailSingle = new \App\adms\Models\helper\AdmsValEmailSingle();
        $valEmailSingle->validateEmailSingle($this->data['email'], true, $this->data['id']);

        $valUserSingle = new \App\adms\Models\helper\AdmsValUserSingleLogin();
        $valUserSingle->validateUserSingleLogin($this->data['username'], true, $this->data['id']);

      
        if ($valEmail->getResult() AND $valEmailSingle->getResult() AND $valUserSingle->getResult()) {
            $this->edit();
        } else {
            $this->result = false;
        }
    }

    private function edit() {
        $this->data['nickname'] = $this->dataExitVal['nickname'];
        $this->data['modified'] = date("Y-m-d H:i:s");

        $upUser = new \App\adms\Models\helper\AdmsUpdate();
        $upUser->exeUpdate("adms_users", $this->data, "WHERE id =:id", "id={$this->data['id']}");

        if ($upUser->getResult()) {
            $_SESSION['msg'] = "<div class='alert alert-success' role='alert'>Usuário editado com sucesso!</div>";
            $this->result = true;
        } else {
            $_SESSION['msg'] = "<div class='alert alert-danger' role='alert'>Erro: Usuário não editado!</div>";
            $this->result = false;
        }
    }

    public function listSelect() {
        $list = new \App\adms\Models\helper\AdmsRead();
        $list->fullRead("SELECT id id_sit, name name_sit FROM adms_sits_users ORDER BY name ASC");
        $registry['sit'] = $list->getReadingResult();

        $list->fullRead("SELECT id id_lev, name name_lev 
        FROM adms_access_levels 
        WHERE order_levels >:order_levels
        ORDER by name ASC", "order_levels=" . $_SESSION['order_levels']);

        $registry['lev'] = $list->getReadingResult();

        $this->listRegistryEdit = ['sit' => $registry['sit'], 'lev' => $registry['lev']];

        return $this->listRegistryEdit;
    }

}

?>